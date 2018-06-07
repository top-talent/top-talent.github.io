var margin = {top: 30, left:40, right:100, bottom:50},
  width = 960 - 100 - margin.left - margin.right,
  height = 650 - margin.top - margin.bottom;

// x, y range of chart1
var x = d3.scale.linear().range([0, width]);
var y = d3.scale.linear().range([height, 0]);
var xAxis = d3.svg.axis()
    .scale(x)
    .orient("bottom");
var yAxis = d3.svg.axis()
    .scale(y)
    .orient("left");

function make_x_axis() {        
    return d3.svg.axis()
        .scale(x)
         .orient("bottom")
         .ticks(10)
}
function make_y_axis() {        
    return d3.svg.axis()
        .scale(y)
        .orient("left")
        .ticks(10)
}
//x, y range of chcart2
var x2 = d3.scale.linear().range([0, width]);
var y2 = d3.scale.linear().range([height, 0]);
var xAxis2 = d3.svg.axis()
    .scale(x2)
    .orient("bottom");
var yAxis2 = d3.svg.axis()
    .scale(y2)
    .orient("left");
function make_x_axis2() {        
    return d3.svg.axis()
        .scale(x2)
         .orient("bottom")
         .ticks(10)
}
function make_y_axis2() {        
    return d3.svg.axis()
        .scale(y2)
        .orient("left")
        .ticks(10)
}

// x,y range of chart3
var x3 = d3.scale.linear().range([0, width]);
var y3 = d3.scale.linear().range([height, 0]);
// x,y range of chart4
var x4 = d3.scale.linear().range([0, width]);
var y4 = d3.scale.sqrt().range([height, 0]);
var xAxis4 = d3.svg.axis()
    .scale(x4)
    .orient("bottom");
var yAxis4 = d3.svg.axis()
    .scale(y4)
    .orient("left");
function make_x_axis4() {        
    return d3.svg.axis()
        .scale(x4)
         .orient("bottom")
         .ticks(10)
}
function make_y_axis4() {        
    return d3.svg.axis()
        .scale(y4)
        .orient("left")
        .ticks(10)
}    
// x,y range of chart5
var x5 = d3.scale.linear().range([0, width]);
var y5 = d3.scale.log().range([height, 0]);
var xAxis5 = d3.svg.axis()
    .scale(x5)
    .orient("bottom");
var yAxis5 = d3.svg.axis()
    .scale(y5)
    .orient("left");
function make_x_axis5() {        
    return d3.svg.axis()
        .scale(x5)
         .orient("bottom")
         .ticks(10)
}
function make_y_axis5() {        
    return d3.svg.axis()
        .scale(y5)
        .orient("left")
        .ticks(10)
}  

// svg append to the each position.
var svg1 = d3.select("div#chart1").append("svg")
  .attr("width", width + 100 + margin.left + margin.right) 
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", "translate(" + 0 + "," + margin.bottom + ")");
var svg2 = d3.select("div#chart2").append("svg")
  .attr("width", width + 100 + margin.left + margin.right) 
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", "translate(" + 0 + "," + margin.bottom + ")"); 
var svg3 = d3.select("div#chart3").append("svg")
  .attr("width", width + 100 + margin.left + margin.right) 
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", "translate(" + 0 + "," + margin.bottom + ")"); 
var svg4 = d3.select("div#chart4").append("svg")
  .attr("width", width + 100 + margin.left + margin.right) 
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", "translate(" + 0 + "," + margin.bottom + ")"); 
var svg5 = d3.select("div#chart5").append("svg")
  .attr("width", width + 100 + margin.left + margin.right) 
  .attr("height", height + margin.top + margin.bottom)
  .append("g")
  .attr("transform", "translate(" + 0 + "," + margin.bottom + ")"); 

//title of the chart1, chart2, chart3, chart4, chart5.
svg1.append("text")
  .attr("class", "title")
  .text("Plasma Glucose vs. Insulin")
  .attr("transform", "translate(30,-20)")
  .style("font-size", 20);
svg2.append("text")
  .attr("class", "title")
  .text("BMI vs. Blood Pressure")
  .attr("transform", "translate(30,-20)")
  .style("font-size", 20);
svg3.append("text")
  .attr("class", "title")
  .text("Plasma Glucose vs. Insulin, scaled symbols")
  .attr("transform", "translate(30,-20)")
  .style("font-size", 20);  
svg4.append("text")
  .attr("class", "title")
  .text("Plasma Glucose vs. Insulin (square-root-scaled)") 
  .attr("transform", "translate(30,-20)")
  .style("font-size", 20);  
svg5.append("text")
  .attr("class", "title")
  .text("Plasma Glucose vs. Insulin (log-scaled)")
  .attr("transform", "translate(30,-20)")
  .style("font-size", 20);
  // add legend for chart1, chart2, chat3, chart4, chart5.  
  // legend1
  var legend1 = svg1.append("g")
    .attr("class", "legend")
    .attr("height", 100)
    .attr("width", 100)
    .attr("transform", "translate("+ (width+45)+ ",60)");
  var triangle = legend1.append("path")
    .attr("d", d3.svg.symbol().type("triangle-up"))
    .attr("fill", "none")
    .attr("stroke", "red")
    .attr("transform", "translate(20,20)");
  legend1.append("text")
      .attr("x", 40)
    .attr("y", 20)
    .attr("dy", ".15em")
    .text("positive")
    .attr("font-size", 20); 
  var circle = legend1.append("circle")
    .attr("cx", 20)
    .attr("cy", 50)
    .attr("r", 6)
    .attr("fill", "none")
    .attr("stroke", "blue");
  legend1.append("text")
    .attr("x", 40)
    .attr("y", 50)
    .attr("dy", ".15em")
    .text("negative")
    .attr("font-size", 20); 
  // legend2
  var legend2 = svg2.append("g")
    .attr("class", "legend")
    .attr("height", 100)
    .attr("width", 100)
    .attr("transform", "translate("+ (width+45)+ ",60)");
  legend2.append("path")
    .attr("d", d3.svg.symbol().type("triangle-up"))
    .attr("fill", "none")
    .attr("stroke", "red")
    .attr("transform", "translate(20,20)");
  legend2.append("text")
      .attr("x", 40)
    .attr("y", 20)
    .attr("dy", ".15em")
    .text("positive")
    .attr("font-size", 20); 
  legend2.append("circle")
    .attr("cx", 20)
    .attr("cy", 50)
    .attr("r", 6)
    .attr("fill", "none")
    .attr("stroke", "blue");
  legend2.append("text")
    .attr("x", 40)
    .attr("y", 50)
    .attr("dy", ".15em")
    .text("negative")
    .attr("font-size", 20);   
  // legend3 
  var legend3 = svg3.append("g")
    .attr("class", "legend")
    .attr("height", 100)
    .attr("width", 100)
    .attr("transform", "translate("+ (width+45)+ ",60)");
  legend3.append("path")
    .attr("d", d3.svg.symbol().type("triangle-up"))
    .attr("fill", "none")
    .attr("stroke", "red")
    .attr("transform", "translate(20,20)");
  legend3.append("text")
      .attr("x", 40)
    .attr("y", 20)
    .attr("dy", ".15em")
    .text("positive")
    .attr("font-size", 20); 
 legend3.append("circle")
    .attr("cx", 20)
    .attr("cy", 50)
    .attr("r", 6)
    .attr("fill", "none")
    .attr("stroke", "blue");
  legend3.append("text")
    .attr("x", 40)
    .attr("y", 50)
    .attr("dy", ".15em")
    .text("negative")
    .attr("font-size", 20);   
 
  // legend4 
  var legend4 = svg4.append("g")
    .attr("class", "legend")
    .attr("height", 100)
    .attr("width", 100)
    .attr("transform", "translate("+ (width+45)+ ",60)");
  legend4.append("path")
    .attr("d", d3.svg.symbol().type("triangle-up"))
    .attr("fill", "none")
    .attr("stroke", "red")
    .attr("transform", "translate(20,20)");
  legend4.append("text")
      .attr("x", 40)
    .attr("y", 20)
    .attr("dy", ".15em")
    .text("positive")
    .attr("font-size", 20); 
legend4.append("circle")
    .attr("cx", 20)
    .attr("cy", 50)
    .attr("r", 6)
    .attr("fill", "none")
    .attr("stroke", "blue");
  legend4.append("text")
    .attr("x", 40)
    .attr("y", 50)
    .attr("dy", ".15em")
    .text("negative")
    .attr("font-size", 20);   

  // legend5 
  var legend5 = svg5.append("g")
    .attr("class", "legend")
    .attr("height", 100)
    .attr("width", 100)
    .attr("transform", "translate("+ (width+45)+ ",60)");
  legend5.append("path")
    .attr("d", d3.svg.symbol().type("triangle-up"))
    .attr("fill", "none")
    .attr("stroke", "red")
    .attr("transform", "translate(20,20)");
  legend5.append("text")
    .attr("x", 40)
    .attr("y", 20)
    .attr("dy", ".15em")
    .text("positive")
    .attr("font-size", 20); 
  legend5.append("circle")
    .attr("cx", 20)
    .attr("cy", 50)
    .attr("r", 6)
    .attr("fill", "none")
    .attr("stroke", "blue");
  legend5.append("text")
    .attr("x", 40)
    .attr("y", 50)
    .attr("dy", ".15em")
    .text("negative")
    .attr("font-size", 20);

// get the data from the csv file.
d3.csv("diabetes.csv", function(error, data){
  if(error) throw error;

  // get the datas
  data.forEach(function(d){
    // chart1 data
    d.x1 = +d.plasma_glucose;
    d.y1 = +d.insulin;
    // chart2 data
    d.x2 = +d.bmi;
    d.y2 = +d.blood_pressure;
  });

  // x, y domain of chart1
  x.domain(d3.extent(data, function(d) { return d.x1; })).nice();
  y.domain(d3.extent(data, function(d) { return d.y1; })).nice();
  //x,y domain of chart2
  x2.domain(d3.extent(data, function(d) { return d.x2; })).nice();
  y2.domain(d3.extent(data, function(d) { return d.y2; })).nice();
  //x,y domain of chart3
  x3.domain(d3.extent(data, function(d) { return d.x1; })).nice();
  y3.domain(d3.extent(data, function(d) { return d.y1; })).nice();
  //x,y domain of chart4
  x4.domain(d3.extent(data, function(d) { return d.x1; })).nice();
  y4.domain(d3.extent(data, function(d) { return d.y1; })).nice();
  //x,y domain of chart4
  x5.domain(d3.extent(data, function(d) { return d.x1; })).nice();
  y5max = d3.max(data, function(d){return d.y1;});
  y5min = 1;
  y5.domain([y5min, y5max + 100]);
  // age scale for chart3.
  var agescale = d3.scale.linear()
    .domain(d3.extent(data, function(d){ return parseInt(d.age);}))
    .range([30, 500]);

  // add the axis of the chart1, chart2, chart3, chart4, chart5.
  // draw axis and grid of chart1
  svg1.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + margin.left + "," + height + ")")
      .call(xAxis)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", 1)
      .attr("dy", -20)
      .style("text-anchor", "end")
      .text("Plasma Glucose");
  svg1.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")") 
      .call(yAxis)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 1)
      .attr("dx", -20)
      .attr("dy", "1.7em")
      .style("text-anchor", "end")
      .text("Insulin");
  svg1.append("g")         
        .attr("class", "grid")
        .attr("transform", "translate(" + margin.left + "," + height + ")")
        .style("stroke-dasharray", "7,7")
        .call(make_x_axis()
            .tickSize(-height)
            .tickFormat("")
        )
  svg1.append("g")         
      .attr("class", "grid")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")")
      .style("stroke-dasharray", "7,7")
      .call(make_y_axis()
          .tickSize(-width)
          .tickFormat("")
      )
// draw axis and grid of chart2
  svg2.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + margin.left + "," + height + ")")
      .call(xAxis2)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", 1)
      .attr("dy", -20)
      .style("text-anchor", "end")
      .text("BMI");
  svg2.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")") 
      .call(yAxis2)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 1)
      .attr("dx", -20)
      .attr("dy", "1.7em")
      .style("text-anchor", "end")
      .text("Blood Pressure"); 
  svg2.append("g")         
        .attr("class", "grid")
        .attr("transform", "translate(" + margin.left + "," + height + ")")
        .style("stroke-dasharray", "7,7")
        .call(make_x_axis2()
            .tickSize(-height)
            .tickFormat("")
        )
  svg2.append("g")         
      .attr("class", "grid")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")")
      .style("stroke-dasharray", "7,7")
      .call(make_y_axis2()
          .tickSize(-width)
          .tickFormat("")
      )
  // draw axis and grid of chart3      
  svg3.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + margin.left + "," + height + ")")
      .call(xAxis)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", 1)
      .attr("dy", -20)
      .style("text-anchor", "end")
      .text("Plasma Glucose");
  svg3.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")") 
      .call(yAxis)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 1)
      .attr("dx", -20)
      .attr("dy", "1.7em")
      .style("text-anchor", "end")
      .text("Insulin");         
  svg3.append("g")         
        .attr("class", "grid")
        .attr("transform", "translate(" + margin.left + "," + height + ")")
        .style("stroke-dasharray", "7,7")
        .call(make_x_axis()
            .tickSize(-height)
            .tickFormat("")
        )
  svg3.append("g")         
      .attr("class", "grid")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")")
      .style("stroke-dasharray", "7,7")
      .call(make_y_axis()
          .tickSize(-width)
          .tickFormat("")
      )
  // draw axis and grid of chart4
  svg4.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + margin.left + "," + height + ")")
      .call(xAxis4)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", 0)
      .attr("dy", -20)
      .style("text-anchor", "end")
      .text("Plasma Glucose");
  svg4.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")") 
      .call(yAxis4)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 0)
      .attr("dx", -20)
      .attr("dy", "1.7em")
      .style("text-anchor", "end")
      .text("Insulin");   
  svg4.append("g")         
        .attr("class", "grid")
        .attr("transform", "translate(" + margin.left + "," + height + ")")
        .style("stroke-dasharray", "7,7")
        .call(make_x_axis4()
            .tickSize(-height)
            .tickFormat("")
        )
  svg4.append("g")         
      .attr("class", "grid")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")")
      .style("stroke-dasharray", "7,7")
      .call(make_y_axis4()
          .tickSize(-width)
          .tickFormat("")
      )  
  // draw axis and grid of chart5
  svg5.append("g")
      .attr("class", "x axis")
      .attr("transform", "translate(" + margin.left + "," + height + ")")
      .call(xAxis5)
    .append("text")
      .attr("class", "label")
      .attr("x", width)
      .attr("y", 1)
      .attr("dy", -20)
      .style("text-anchor", "end")
      .text("Plasma Glucose");
  svg5.append("g")
      .attr("class", "y axis")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")") 
      .call(yAxis5)
    .append("text")
      .attr("class", "label")
      .attr("transform", "rotate(-90)")
      .attr("y", 1)
      .attr("dx", -20)
      .attr("dy", "1.7em")
      .style("text-anchor", "end")
      .text("Insulin");   
  svg5.append("g")         
        .attr("class", "grid")
        .attr("transform", "translate(" + margin.left + "," + height + ")")
        .style("stroke-dasharray", "7,7")
        .call(make_x_axis5()
            .tickSize(-height)
            .tickFormat("")
        )
  svg5.append("g")         
      .attr("class", "grid")
      .attr("transform", "translate(" + margin.left + "," + 0 + ")")
      .style("stroke-dasharray", "7,7")
      .call(make_y_axis5()
          .tickSize(-width)
          .tickFormat("")
      )
  // add the points of chart1, chart2, chart3, chart4, chart5.  
  data.forEach(function(d){
    // scaling of the graph3.
    var rval = 0;
        if(d.x1 == 0 && d.y1 == 0){
          rval = 100;
        }else if(d.x1 == 0){
          rval = 1 * d.y1;
        }else if(d.y1 == 0){
          rval = d.x1 * 1
        }else{
          rval = d.x1 * d.y1;
        }
        var rval = rval/100;

    if(parseInt(d.class) == 1){
      svg1.append("path").attr("d", d3.svg.symbol().type("triangle-up"))
      .attr("transform", "translate(" + (x(d.x1) + margin.left) + "," + y(d.y1) + ")")
      .attr("fill", "none")
      .attr("stroke", "red");
      svg2.append("path").attr("d", d3.svg.symbol().type("triangle-up"))
      .attr("transform", "translate(" + (x2(d.x2) + margin.left) + "," + y2(d.y2) + ")")
      .attr("fill", "none")
      .attr("stroke", "red");

      var age = parseInt(d.age);
      var arc = d3.svg.symbol().type("triangle-up").size(rval);
      svg3.append("path").attr("d", arc)
      .attr("transform", "translate(" + (x(d.x1) + margin.left) + "," + y(d.y1) + ")")
      .attr("fill", "none")
      .attr("stroke", "red");
      svg4.append("path").attr("d", d3.svg.symbol().type("triangle-up"))
      .attr("transform", "translate(" + (x4(d.x1) + margin.left) + "," + y4(d.y1) + ")")
      .attr("fill", "none")
      .attr("stroke", "red");
      svg5.append("path").attr("d", d3.svg.symbol().type("triangle-up"))
      .attr("transform", "translate(" + (x5(d.x1) + margin.left) + "," + y5(d.y1 + 1) + ")")
      .attr("fill", "none")
      .attr("stroke", "red");
      var age = parseInt(d.age);  
    }else{
      svg1.append("circle").attr("r", 5)
        .attr("cx", (x(d.x1) + margin.left))
        .attr("cy", y(d.y1))
        .attr("fill", "none")
        .attr("stroke", "blue");
      svg2.append("circle").attr("r", 5)
        .attr("cx", (x2(d.x2) + margin.left))
        .attr("cy", y2(d.y2))
        .attr("fill", "none")
        .attr("stroke", "blue");  

      var arc = d3.svg.symbol().type("circle").size(rval);
      svg3.append("path").attr("d", arc)
        .attr("transform", "translate(" + (x(d.x1) + margin.left) + "," + y(d.y1) + ")")
        .attr("fill", "none")
        .attr("stroke", "blue");
      svg4.append("circle")
        .attr("r", 5)
        .attr("cx", (x4(d.x1) + margin.left))
        .attr("cy", y4(d.y1))
        .attr("fill", "none")
        .attr("stroke", "blue");
      svg5.append("circle").attr("r", 5)
        .attr("cx", (x5(d.x1) + margin.left))
        .attr("cy", y5(d.y1 + 1))
        .attr("fill", "none")
        .attr("stroke", "blue");  
    }   
  });
}); 

