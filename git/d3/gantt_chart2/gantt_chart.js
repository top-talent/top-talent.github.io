/**
 * @author Webmaster444
 * @version 2.0
 */
d3.gantt = function() {
    var FIT_TIME_DOMAIN_MODE = "fit";
    var FIXED_TIME_DOMAIN_MODE = "fixed";

    var margin = {
        top: 20,
        right: 40,
        bottom: 20,
        left: 150
    };

    var timeDomainStart = d3.time.day.offset(new Date(), -3);
    var timeDomainEnd = d3.time.hour.offset(new Date(), +3);
    var timeDomainMode = FIT_TIME_DOMAIN_MODE; // fixed or fit
    var taskTypes = [];
    var taskStatus = [];
    var height = document.body.clientHeight - margin.top - margin.bottom - 5;
    var focus_height = height - 150;
    var height2 = 120;
    var width = document.body.clientWidth - margin.right - margin.left - 5;

    var tickFormat = "%H:%M";

    var keyFunction = function(d) {
        return d.startDate + d.machineId + d.endDate;
    };

    var rectTransform = function(d) {
        return "translate(" + x(d.startDate) + "," + y(d.machineId) + ")";
    };

    //initialize time domain 
    var initTimeDomain = function(tasks) {
        if (timeDomainMode === FIT_TIME_DOMAIN_MODE) {
            if (tasks === undefined || tasks.length < 1) {
                timeDomainStart = d3.time.day.offset(new Date(), -3);
                timeDomainEnd = d3.time.hour.offset(new Date(), +3);
                return;
            }
            tasks.sort(function(a, b) {
                return a.endDate - b.endDate;
            });
            timeDomainEnd = tasks[tasks.length - 1].endDate;
            tasks.sort(function(a, b) {
                return a.startDate - b.startDate;
            });
            timeDomainStart = tasks[0].startDate;
        }
    };

    //initialize x axis, y axis based on time domain
    var initAxis = function() {
        x = d3.time.scale().domain([timeDomainStart, timeDomainEnd]).range([0, width]);
        y = d3.scale.ordinal().domain(taskTypes).rangeRoundBands([0, focus_height - margin.top - margin.bottom], .1);

        x2 = d3.time.scale().domain([timeDomainStart, timeDomainEnd]).range([0, width]).clamp(true);
        y2 = d3.scale.ordinal().domain(taskTypes).rangeRoundBands([0, 120], .1);

        xAxis = d3.svg.axis().scale(x).orient("bottom").tickFormat(d3.time.format(tickFormat)).tickSubdivide(true)
            .tickSize(-focus_height + 45).tickPadding(8).outerTickSize(8);
        xAxis2 = d3.svg.axis().scale(x2).orient("bottom");

        yAxis = d3.svg.axis().scale(y).orient("left").tickSize(-width).tickPadding(5);
        yAxis2 = d3.svg.axis().scale(y2).orient("left").tickSize(0).tickValues('');
    };

    function gantt(tasks) {

        initTimeDomain(tasks);
        initAxis();

        var brush = d3.svg.brush()
            .x(x2)
            .on("brush", brushed);

        var svg = d3.select("body")
            .append("svg")
            .attr("class", "chart")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom);

        svg.append("defs").append("clipPath")
            .attr("id", "clip")
            .append("rect")
            .attr("width", width)
            .attr("height", focus_height);

        var focus = svg.append("g")
            .attr("class", "gantt-chart focus")
            .attr("transform", "translate(" + margin.left + ", " + margin.top + ")");

        var context = svg.append("g")
            .attr("class", "context")
            .attr("transform", "translate(" + margin.left + "," + parseInt(focus_height + 30) + ")");

        var zoom = d3.behavior.zoom()
            .on("zoom", draw);

        var rect = svg.append("svg:rect")
            .attr("class", "pane")
            .attr("width", width)
            .attr("height", focus_height + margin.top + margin.bottom - 80)
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")")
            .on("mouseout",function(){
                var redline = d3.select('.red_line').style('display','none');
            })
            .on("mouseover",function(){
                var redline = d3.select('.red_line').style('display','block');
            })
            .on("mousemove",function(d){
                var coordinates = [0, 0];
                coordinates = d3.mouse( this);
                var x = coordinates[0];
                
                var redline = d3.select('.red_line').attr('x1',x).attr('x2',x);
            })
            .call(zoom);

        //Add axis in 1st chart
        focus.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0, " + (focus_height - margin.top - margin.bottom) + ")")
            .transition()
            .call(xAxis);

        focus.append("g").attr("class", "y axis").transition().call(yAxis);

        var box_container = focus.append("g").attr('class','box_container');

        zoom.x(x);

        //Add axis in 2nd chart
        context.append("g")
            .attr("class", "x axis")
            .attr("transform", "translate(0," + height2 + ")")
            .call(xAxis2);

        context.append("g")
            .attr("class", "y axis")
            .attr("transform", "translate(0," + 0 + ")")
            .call(yAxis2);

        // axis styling in 1st chart
        focus.selectAll(".domain").remove();
        focus.selectAll("g.x .tick line").attr("stroke", "#777").attr("stroke-dasharray", "2,2");
        
        //Add boxes to 1st chart
        var g_containers = box_container.selectAll(".chart")
            .data(tasks, keyFunction).enter()
            .append('g')
            .attr('class', 'box')
            .attr("transform", rectTransform);

        g_containers.append("rect")
            .attr("class", function(d) {
                if (taskStatus[d.caster] == null) {
                    return "task_style_1";
                }
                return taskStatus[d.caster];
            })
            .attr("y", 0)
            .attr('stroke', 'black')
            .attr('stroke-opacity', .3)
            .attr("stroke-dasharray", function(d) {
                var tmp_width = x(d.endDate) - x(d.startDate);
                return '0, ' + tmp_width + ',' + y.rangeBand() + ', ' + tmp_width + ',' + y.rangeBand();
            })
            .attr("height", function(d) {
                return y.rangeBand();
            })
            .attr("width", function(d) {
                return (x(d.endDate) - x(d.startDate));
            });

        //Add text to boxes its grade,duration or so
        g_containers.append("text")
            .attr('class', 'txt_grade')
            .attr('font-size', '10px')
            .attr("x", function(d) {
                return 5;
            })
            .attr("y", 8)
            .attr("dy", ".35em")
            .text(function(d) {
                return d.grade;
            });

        g_containers.selectAll('.txt_grade').text(function(d) {
            var current_length = this.getComputedTextLength();
            var g_c = d3.select(this.parentNode);
            var rect_length = g_c.select('rect').attr('width');
            if (rect_length - 5 > current_length) {
                return d.grade;
            }
            var temp_st = d.grade;
            var res = temp_st.substring(0, 5);
            return res + '...';
        });

        g_containers.append("text")
            .attr('class', 'txt_id')
            .attr('font-size', '10px')
            .attr('font-weight', '700')
            .attr("x", function(d) {
                return (x(d.endDate) - x(d.startDate)) / 2 - 5
            })
            .attr("y", function(d) {
                return y.rangeBand() / 2;
            })
            .attr("dy", ".35em")
            .text(function(d) {
                return d.boxIndex;
            });

        g_containers.append("text")
            .attr('class', 'txt_duration')
            .attr('font-size', '10px')
            .attr("x", function(d) {
                return (x(d.endDate) - x(d.startDate)) - 15;
            })
            .attr("y", function(d) {
                return y.rangeBand() - 5;
            })
            .attr("dy", ".35em")
            .text(function(d) {
                return d.duration;
            });
        
        var bbox_container = context.append('g').attr('class','bbox_container');

        var sec_g_containers = bbox_container.selectAll(".chart").data(tasks, keyFunction).enter()
            .append('g')
            .attr("transform", function(d) {
                return "translate(" + x(d.startDate) + "," + y2(d.machineId) + ")";
            });

        sec_g_containers.append("rect")
            .attr("class", function(d) {
                if (taskStatus[d.caster] == null) {
                    return "task_style_1";
                }
                return taskStatus[d.caster];
            })
            .attr("y", 0)
            .attr('stroke', 'black')
            .attr('stroke-opacity', .3)
            .attr("stroke-dasharray", function(d) {
                var tmp_width = x(d.endDate) - x(d.startDate);
                return '0, ' + tmp_width + ',' + y2.rangeBand() + ', ' + tmp_width + ',' + y2.rangeBand();
            })
            .attr("height", function(d) {
                return y2.rangeBand();
            })
            .attr("width", function(d) {
                return (x(d.endDate) - x(d.startDate));
            });

        //Add red line to make hover effect
        focus.append('line').attr('class','red_line').attr("x1", 0).style('stroke','red') 
            .attr("y1", 8) 
            .attr("x2", 0) 
            .attr("y2", focus_height - margin.top - margin.bottom);


        //Add brush
        context.append("g")
            .attr("class", "x brush")
            .call(brush)
            .selectAll("rect")
            .attr("y", 0)
            .attr("height", height2);

        //Cutomize brush handles
        var brush_content = svg.selectAll('g.resize.e');

        brush_content.append('circle')
            .attr("transform", function(d) { return "translate(0,60 )"; })
            .attr("fill","black")
            .attr("r", 12);

        brush_content.append('circle')
            .attr("transform", function(d) { return "translate(0,60 )"; })
            .attr("fill","white")
            .attr("r", 3.5);

        brush_content = svg.selectAll('g.resize.w');
        
        brush_content.append('circle')
            .attr("transform", function(d) { return "translate(0,60 )"; })
            .attr("fill","black")
            .attr("r", 12);        
        brush_content.append('circle')
            .attr("transform", function(d) { return "translate(0,60 )"; })
            .attr("fill","white")
            .attr("r", 3.5);

        //Add y axis line in 1st chart
        focus.append('line').attr('class', 'y_axis').style("stroke", "black") 
            .attr("x1", 0) 
            .attr("y1", 8) 
            .attr("x2", 0) 
            .attr("y2", focus_height - margin.top - margin.bottom);

        //init brush
        brushed();
        draw();
        function brushed() {
            x.domain(brush.empty() ? x2.domain() : brush.extent());
            
            //redraw x axis in 1st chart
            focus.select(".x.axis").call(xAxis);

            //Highlight view area
            var tmp_domain = new Array();
            tmp_domain = x.domain();
            bbox_container.selectAll('g').data(tasks,keyFunction).classed('active',function(d){
                var ts =d.startDate;
                var es = d.endDate;
                if((ts>tmp_domain[0])&&(es<tmp_domain[1])){
                    return true;
                }else{
                    return false;
                }
            });
            //Redraw boxes
            gantt.redraw(tasks);
            
            // Reset zoom scale's domain
            zoom.x(x);
        }

        function draw() {
            focus.select(".x.axis").call(xAxis);
            
            // Force changing brush range
            brush.extent(x.domain());

            //Highlight view area
            var tmp_domain = new Array();
            tmp_domain = x.domain();
            bbox_container.selectAll('g').data(tasks,keyFunction).classed('active',function(d){
                var ts =d.startDate;
                var es = d.endDate;
                if((ts>tmp_domain[0])&&(es<tmp_domain[1])){
                    return true;
                }else{
                    return false;
                }
            });

            svg.select(".brush").call(brush);
            
            // Redraw boxes
            gantt.redraw(tasks);
        }

        return gantt;
    };

    //Redraw boxes in 1st chart
    gantt.redraw = function(tasks) {
        var svg = d3.select("svg");

        var ganttChartGroup = svg.select(".gantt-chart");

        svg.selectAll(".txt_grade").remove();
        svg.selectAll(".txt_id").remove();
        svg.selectAll(".txt_duration").remove();
        
        // svg.selectAll(".init_circle").remove();
        var fc = d3.select('.focus');
        fc.selectAll(".domain").remove();    

        var g_wrappers = ganttChartGroup.selectAll('.box').data(tasks, keyFunction).attr("transform", rectTransform);

        var rect = ganttChartGroup.selectAll("rect").data(tasks, keyFunction);
        svg.selectAll("g.x .tick line").attr("stroke", "#777").attr("stroke-dasharray", "2,2");
        rect.enter()
            .insert("rect", ":first-child")
            .attr("class", function(d) {
                if (taskStatus[d.status] == null) {
                    return "task_style_1";
                }
                return taskStatus[d.status];
            })

            .attr("y", 0)
            .attr("height", function(d) {
                return y.rangeBand();
            })
            .attr("width", function(d) {
                return (x(d.endDate) - x(d.startDate));
            });

        rect
            .attr('stroke', 'black')
            .attr('stroke-opacity', .3)
            .attr("stroke-dasharray", function(d) {
                var tmp_width = x(d.endDate) - x(d.startDate);
                return '0, ' + tmp_width + ',' + y.rangeBand() + ', ' + tmp_width + ',' + y.rangeBand();
            })
            .attr("height", function(d) {
                return y.rangeBand();
            })
            .attr("width", function(d) {
                return (x(d.endDate) - x(d.startDate));
            });

        rect.exit().remove();

        g_wrappers.append("text")
            .attr('class', 'txt_grade')
            .attr('font-size', '10px')
            .attr("x", function(d) {
                return 5;
            })
            .attr("y", 8)
            .attr("dy", ".35em")
            .text(function(d) {
                return d.grade;
            });

        g_wrappers.selectAll('.txt_grade').text(function(d) {
            var current_length = this.getComputedTextLength();
            var g_c = d3.select(this.parentNode);
            var rect_length = g_c.select('rect').attr('width');

            if (rect_length - 5 > current_length) {
                return d.grade;
            }
            var temp_st = d.grade;
            var res = temp_st.substring(0, 5);
            return res + '...';

        });

        g_wrappers.append("text")
            .attr('class', 'txt_id')
            .attr('font-size', '10px')
            .attr('font-weight', '700')
            .attr("x", function(d) {
                return (x(d.endDate) - x(d.startDate)) / 2 - 5
            })
            .attr("y", function(d) {
                return y.rangeBand() / 2;
            })
            .attr("dy", ".35em")
            .text(function(d) {
                var current_length = this.getComputedTextLength();
                var g_c = d3.select(this.parentNode);
                var rect_length = g_c.select('rect').attr('width');

                return d.boxIndex;
            });

        g_wrappers.append("text")
            .attr('class', 'txt_duration')
            .attr('font-size', '10px')
            .attr("x", function(d) {
                return (x(d.endDate) - x(d.startDate)) - 15;
            })
            .attr("y", function(d) {
                return y.rangeBand() - 5;
            })
            .attr("dy", ".35em")
            .text(function(d) {
                var current_length = this.getComputedTextLength();
                var g_c = d3.select(this.parentNode);
                var rect_length = g_c.select('rect').attr('width');

                return d.duration;
            });
    
        return gantt;
    };

    gantt.taskTypes = function(value) {
        if (!arguments.length)
            return taskTypes;
        taskTypes = value;
        return gantt;
    };

    gantt.taskStatus = function(value) {
        if (!arguments.length)
            return taskStatus;
        taskStatus = value;
        return gantt;
    };

    gantt.tickFormat = function(value) {
        if (!arguments.length)
            return tickFormat;
        tickFormat = value;
        return gantt;
    };

    return gantt;
};