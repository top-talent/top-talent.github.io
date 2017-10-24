var datas = [{club:'Manchester United',value:{year_2013:3165, year_2014:2810, year_2015:3100, year_2016:3317, year_2017:4583}},
{club:'Chelsea',value:{year_2013:901, year_2014:868, year_2015:1370, year_2016:1661, year_2017:1845}},
{club:'Manchester City',value:{year_2013:689, year_2014:863, year_2015:1380, year_2016:1921, year_2017:2083}},
{club:'Liverpool',value:{year_2013:651, year_2014:704, year_2015:982, year_2016:1548, year_2017:1492}},
{club:'Arsenal',value:{year_2013:1326, year_2014:1331, year_2015:1310, year_2016:2017, year_2017:1932}}];
var st_flag = true;
var margin = {top:20, left:30, right:30, bottom:20},
	width = 1200 - margin.left - margin.right,
	height = 500 - margin.top - margin.bottom;

var key = [];
var data = [];
dorder = [];
datas.forEach(function(d){
	var dt = Object.values(d.value);
	var val = 0;
	for(var i = 0; i<dt.length; i++){
		val += dt[i];
	}
	var dkey = Object.values(d);
	var dk = {key: dkey[0],
					val: val};
	dorder.push(dk);				
});

for(var i = 0; i < dorder.length; i++){
	data.push(dorder[dorder.length - 1 - i]);
};
// add svg to the body
var svg = d3.select("body").append("svg")
	.attr("width", width + margin.left + margin.right)
	.attr("height", height + margin.top + margin.bottom)
	.append("g")
	.attr("transform", "translate(" + 150 + "," + margin.top + ")");

// x range
var x = d3.scale.linear()
	.range([0, width/2])
	.domain([0, d3.max(data, function(d){
		return d.val;
	})]);	 

// y range
var y = d3.scale.ordinal()
	.rangeRoundBands([height, 0], .3)
	.domain(data.map(function(d){return d.key;}));

// make y axis to show bar names
var yAxis = d3.svg.axis().scale(y).tickSize(0).orient("left");

var gy = svg.append("g")
	.attr("class","y axis")
	.call(yAxis)
	.style("fill","black")
	.style("stroke", 'none');

// add bar to the svg
var bars = svg.selectAll(".bar")
	.data(data)
	.enter()
	.append("g")
	.on("mouseover", function(d){
		return linechart(d);
	})
	.on("mouseout", function(){
		d3.select(".linechart1").remove();
	});
// append rect 
bars.append("rect")
	.attr("class","bar")
	.attr("y", function(d){
		return y(d.key);
	})
	.attr("height", y.rangeBand())
	.attr("x",5)
	.attr("width", function(d){return x(d.val);})
	.on("mouseover", function(){
		d3.select(this).style("fill", "#29ddf4");
	})
	.on("mouseout", function(){
		d3.select(this).style("fill", "#ccc");
	});

// add a value label to the right of each bar.
bars.append("text")
	.attr("class", "label")
	.attr("y", function(d){
		return y(d.key) + y.rangeBand()/2 + 4;
	})
	.attr("x", function(d){
		return 10;
	})
	.text(function(d){
		return "$" + d.val;
	})
	.style("fill", "#fff")
	.on("mouseover", function(){
		d3.select(this.previousSibling).style("fill", "#29ddf4");
	})
	.on("mouseout", function(){
		d3.select(this.previousSibling).style("fill", "#ccc");
	});

// interactive linechart
var width1 = 250;
var height1 = 250;
var dtv = [];
function linechart(data){
	
	var dkey = data.key;
	dtv = datas.filter(function(d){
		return d.club == dkey;
	});	
	var dataval = [];
	// get the data.
	dtv.forEach(function(d){
		let dt = Object.values(d.value);
		let dtkey = Object.values(d);
		let date = Object.keys(dtkey[1]);
		let year = [];
		date.forEach(function(d){
			let sp = d.split("_");
			year.push(sp[1]);
		});
		let val = 0;
		for(var i =0; i< year.length; i++){
			let arrayval = {year: year[i], value: dt[i]};
			dataval.push(arrayval);
		}
	});

	var parseDate = d3.time.format("%Y").parse;
	// Set the ranges
	var	x = d3.time.scale().range([0, width1]);
	var	y = d3.scale.linear().range([height1, 0]);
	 
	// Define the axes
	var	xaxis = d3.svg.axis().scale(x)
		.orient("bottom").ticks(5);
	 
	var	yaxis = d3.svg.axis().scale(y)
		.orient("left").ticks(5);
	 
	// Define the line
	var	valueline = d3.svg.line()
		.x(function(d) { return x(parseDate(d.year)); })
		.y(function(d) { return y(d.value); });
	    
	// Adds the svg canvas
		svg1 = d3.select("body svg")
			.attr("class", "linechart")
			.append("g")
			.attr("class", "linechart1")
			.attr("transform", "translate(900,50)");;
		// Scale the range of the data
		x.domain(d3.extent(dataval, function(d) { return parseDate(d.year); }));
		var maxval = d3.max(dataval, function(d) { return d.value; });
		var minval = d3.min(dataval, function(d) { return d.value;});
		var limitd = Math.floor((maxval - minval)/4);
		y.domain([minval - limitd, maxval + limitd]);
	 
		// Add the valueline path.		
		svg1.append("path")	
			.attr("class", "line")
			.attr("d", valueline(dataval));
		// Add the X Axis
		svg1.append("g")		
			.attr("class", "x axis")
			.attr("transform", "translate(0," + height1 + ")")
			.call(xaxis)
			.append("text")
			.text("Year")
			.attr("x", 240)
			.attr("y", 40);
	 
		// Add the Y Axis
		svg1.append("g")		
			.attr("class", "y axis")
			.call(yaxis)
			.append("text")
			.text("Value")
			.attr("x", -40)
			.attr("y", -10);
}