var TallyChart = function(data,chart_options){

    var dataset = data;
    var container = chart_options.container;
    var barHeight = chart_options.bar_height;
    var barWidth = chart_options.bar_width;
    var breakAtCount = chart_options.break_at_count;
    var normalTickColor = chart_options.normal_tick_color;
    var breakTickColor = chart_options.break_tick_color;
    var rotateTickDegrees = chart_options.rotate_normal_tick_degrees;
    var margin = chart_options.margin;
    var width = chart_options.width;
    var height = chart_options.height;

    var flags = [], unique_groups=[], l = dataset.length, i;
    flags = [];
    for( i=0; i<l; i++) {
        if( flags[dataset[i].group]) continue;
        flags[dataset[i].group] = true;
        unique_groups.push(dataset[i].group);
    }

    var groupScale = d3.scale.ordinal().domain(unique_groups).rangePoints([0, unique_groups.length-1 ]);
    var categoryScale = d3.scale.ordinal().domain(unique_groups).rangePoints([0, unique_groups.length]);

    var color = d3.scale.category20();

    // Set the ranges
    var	xScale = d3.scale.linear().range([margin.left, width]);
    var	yScale = d3.scale.linear().range([height, margin.bottom]);

    var xAxis = d3.svg.axis()
          .scale(xScale)
          .ticks(0)
          .orient("bottom")
		  .outerTickSize(0);

    var yAxis = d3.svg.axis()
                .scale(yScale)
                .orient("left")
                .tickFormat(function (d) {
                    return unique_groups[d];
                })
                .ticks(unique_groups.length)
				.outerTickSize(0);

    var result = dataset.reduce(function(res, obj) {
        if (!(obj.group in res))
            res.__array.push(res[obj.group] = obj);
        else {
            res[obj.group].count += obj.count;
        }
        return res;
    }, {__array:[]}).__array
                    .sort(function(a,b) { return b.count - a.count; });

    xScale.domain([0,d3.max(dataset,function(d){return d.count;})]);
    yScale.domain([0,d3.max(dataset,function(d){return groupScale(d.group);})]);

    //Create SVG element
    var svg = d3.select(container)
                .append("svg")
                .attr("width", width + margin.left + margin.right)
                .attr("height", height + margin.top + margin.bottom)
                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");


    //CREATE X-AXIS
    /*svg.append("g")
        .attr("class", "x axis")
        .attr("transform", "translate(0," + height + ")")
        .call(xAxis);
	*/

    //Create Y axis
    svg.append("g")
        .attr("transform", "translate(" + margin.left + " ,0)")
        .attr("class", "y axis")
        .call(yAxis);

    svg.select(".y.axis")
        .selectAll("text")
        .style("font-size","15px"); //To change the font size of texts
	

    function generate_array(d){
        var k = 0;
        for(var j=0;j<dataset.length;j++){
            if(groupScale(dataset[j].group) == groupScale(d.group) && categoryScale(dataset[j].group) < categoryScale(d.group)){
                k = k + dataset[j].count;
            }
        }

        var arr = new Array(d.count);
        for(var i=0;i<d.count;i++){
            arr[i] = {y:groupScale(d.group),x:xScale(k+i),group:d.group};
        }

        return arr;
    }

    var groups = svg
       .selectAll("g.group")
       .data( dataset )
        .enter()
        .append('g')
        .attr("class", "group");

    var new_dataset = [];
    var barArray = groups.selectAll("g.barArray")
    .data(function(d) {new_dataset = generate_array(d); return new_dataset;});

    var to_subtract = 0;
    var to_subtract_2 = 0;
    if(new_dataset.length > breakAtCount){
        to_subtract = new_dataset[breakAtCount].x-new_dataset[1].x;
        to_subtract_2 = new_dataset[breakAtCount].x-new_dataset[2].x;
    }
    else{
        to_subtract = xScale(breakAtCount) - xScale(1);
        to_subtract_2 = xScale(breakAtCount) - xScale(2);
    }

    function line_fill_color(d,i){
        return (i+1) % breakAtCount==0 ? breakTickColor : normalTickColor;
    }

    function compute_width(d,i){
        return (i+1)%breakAtCount==0 ? Math.sqrt(Math.pow(to_subtract_2,2) + Math.pow(barHeight,2)) : barWidth;
    }

    function compute_height(d,i){
       return (i+1)%breakAtCount==0 ? 2 : barHeight;
    }

    function compute_line_translations(d,i,j){
        var translate_string = "";
        var rotate_string = "";
        var translate_x = 0;
        var translate_y = 0;
        var rotate_x = 0;

        if((i+1)%breakAtCount==0){
            translate_x = d.x-to_subtract;
            translate_y = yScale(d.y)- barHeight/2;
            rotate_x = Math.atan(barHeight/to_subtract_2)*180/Math.PI;
        }else{
            rotate_x = rotateTickDegrees;
            translate_x = d.x;
            translate_y = yScale(d.y)- barHeight/2;
        }

        translate_string = "translate("+ translate_x + "," +  translate_y +")";
        rotate_string = "rotate(" + rotate_x + ",0,0)";

        return translate_string + " " + rotate_string;
    }

    barArray.enter()
    .append('g')
    .attr("class", "barArray")
    .append("rect")
    .style("fill", function(d,i){return line_fill_color(d,i);})
    .attr("width", function(d,i){return compute_width(d,i);})
    .attr("height", function(d,i){return compute_height(d,i);})
    .attr("transform", function(d,i,j){ return compute_line_translations(d,i,j); })

    var tooltip = d3.select(container)
    .append('div')
    .attr('class', 'tooltip');

    tooltip.append('div')
    .attr('class', 'group');

    svg.selectAll("rect")
    .on('mouseover', function(d,i) {

        tooltip.select('.group').html("<b>Group: " + d.group+ "</b>");

        tooltip.style('display', 'block');
        tooltip.style('opacity',2);

    })
    .on('mousemove', function(d) {
        tooltip.style('top', (d3.event.layerY + 10) + 'px')
        .style('left', (d3.event.layerX - 25) + 'px');
    })
    .on('mouseout', function() {
        tooltip.style('display', 'none');
        tooltip.style('opacity',0);
    });
}
