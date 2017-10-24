function renderFilter(params) {
    // exposed variables
    var attrs = {
        svgWidth: 700,
        svgHeight: 100,
        marginTop: 50,
        marginBottom: 5,
        marginRight: 50,
        marginLeft: 50,
        data: null,
        filterHeight: 40
    };


    /*############### IF EXISTS OVERWRITE ATTRIBUTES FROM PASSED PARAM  #######  */

    var attrKeys = Object.keys(attrs);
    attrKeys.forEach(function (key) {
        if (params && params[key]) {
            attrs[key] = params[key];
        }
    })


    //innerFunctions
    var updateData;


    //main chart object
    var main = function (selection) {
        selection.each(function () {

            //calculated properties
            var calc = {}

            calc.chartLeftMargin = attrs.marginLeft;
            calc.chartTopMargin = attrs.marginTop;
            calc.marginRight = attrs.marginRight;

            calc.chartWidth = attrs.svgWidth - attrs.marginRight - calc.chartLeftMargin;
            calc.chartHeight = attrs.svgHeight - attrs.marginBottom - calc.chartTopMargin;
            calc.filterHeight = attrs.filterHeight;
           
            //drawing
            var svg = d3.select(this)
                .append('svg')
                .attr('width', attrs.svgWidth)
                .attr('height', attrs.svgHeight)
                .style('overflow', 'visible');


            var chart = svg.append('g')
                .attr('transform', 'translate(' + (calc.chartLeftMargin) + ',' + (calc.chartTopMargin - 10 ) +')')


            var chartTitle = svg.append('g')
                .attr('transform', 'translate(' + calc.chartLeftMargin + ',' + (calc.chartTopMargin - 20 )+ ')');

            // pie title 
            chartTitle.append("text")
                .text(attrs.data.title)
                .attr('fill', 'black')
                .style('font-weight', 'bold');



            // Scale
            var xScale = d3.scalePoint()
                .domain(attrs.data.data)
                .range([0, attrs.svgWidth]);

            var x2Scale = d3.scalePoint()
                .domain(attrs.data.data)
                .range([0, attrs.svgWidth]);

            var brushContainer = chart.append("g")
                .attr("class", "brush")
                .attr("fill", "#b1d39c")
                .attr("fill-opacity", "0.3")
                .attr("stroke", "black")
                .attr("stroke-width", "1px")
                .attr("stroke-opacity", "0.3");

            var brush = d3.brushX()
                .extent([[0, 0], [attrs.svgWidth, calc.filterHeight]])
                .on("end", brushed);


            // Text
            brushContainer.append("text")
                .attr("transform", "translate(" + calc.chartLeftMargin + "," + (calc.filterHeight - 10) + ")")
                .text("Click and drag here");

            // Axes
            var xAxis = d3.axisBottom().scale(xScale).tickSize(5);

            brushContainer.call(xAxis);
            brushContainer.call(brush).call(brush).call(brush.move, xScale.range());

            brushContainer.selectAll("rect")
                .attr("y", 0)
                .attr("height", calc.filterHeight);


            function brushed() {
                debugger;

                if (!d3.event.sourceEvent) return; // Only transition after input.
                if (!d3.event.selection) return; // Ignore empty selections.

                var range = xScale.range();
                var s = d3.event.selection || range;

                var rangePoints = d3.range(range[0], range[1] + 1, xScale.step())

                var rangeStart = closest(rangePoints, s[0]);
                var rangeEnd = closest(rangePoints, s[1]);

                var startYear = Number(scalePointPosition(rangeStart));
                var endYear = Number(scalePointPosition(rangeEnd));




                var newRange = [];
                newRange[0] = startYear;
                newRange[1] = endYear;
                
                if(startYear == endYear)
                {
                     var range =  newRange.map(xScale);
                     var updatedRange = [range[0]-10, range[1]+10];
                     d3.select(this).transition().call(d3.event.target.move, updatedRange);
                }
                else{
                   d3.select(this).transition().call(d3.event.target.move, newRange.map(xScale));
                }
               
                attrs.chartUpdateFunc({start : startYear,end : endYear});

            }


            function scalePointPosition(point) {
                var xPos = point;
                var domain = xScale.domain();
                var range = xScale.range();
                var rangePoints = d3.range(range[0], range[1] + 1, xScale.step())
                var yPos = domain[d3.bisect(rangePoints, xPos) - 1];

                return yPos;
            }


            function closest(array, target) {
                var tuples = array.map(function (val) {
                    return [val, Math.abs(val - target)];
                });
                return tuples.reduce(function (memo, val) {
                    return (memo[1] < val[1]) ? memo : val;
                }, [-1, 999])[0];
            }

            // smoothly handle data updating
            updateData = function () {


            }


        });
    };





    ['svgWidth', 'svgHeight'].forEach(key => {
        // Attach variables to main function
        return main[key] = function (_) {
            var string = `attrs['${key}'] = _`;
            if (!arguments.length) { eval(`return attrs['${key}']`); }
            eval(string);
            return main;
        };
    });




    //exposed update functions
    main.data = function (value) {
        if (!arguments.length) return attrs.data;
        attrs.data = value;
        if (typeof updateData === 'function') {
            updateData();
        }
        return main;
    }


    main.onFilterChange = function (chartUpdateFunc) {
       
        attrs.chartUpdateFunc = chartUpdateFunc;
        return main;
    }

    return main;
}
