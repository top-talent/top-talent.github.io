function drawHeatmap(chartWrapper, dataset,oData,selectedKey){
var margin = {top:50, right:0, bottom:100, left:30},
		width=960-margin.left-margin.right,
		height=480-margin.top-margin.bottom,
		gridSize=Math.floor(width/24),
		legendElementWidth=gridSize*2.665,
		buckets = 10,

		colors = ["#f7fcf0","#e0caa3","#dbbc85","#deb66f","#aa7b2a","#be882b","#2b8cbe","#da8425","#e17b18"],
		days = [],
		times = [];
	
	var heatmap;
	var legend;

for(var index in dataset){	
	times.push(dataset[index].key);
}
var blockCnt = 7;
var tmpRows = Math.floor(times.length / blockCnt)
gridSize = Math.floor(width / times.length * tmpRows) - 2;


	var svg = d3.select(chartWrapper).append("svg")
		.attr("width",'100%')
		.attr("height", '100%')
		.attr('viewBox', '0 0 '+ parseInt(width + margin.left+margin.right) + ' ' + parseInt(height+margin.top+margin.bottom))
		.append("g")
		.attr("transform", "translate("+ margin.left+","+margin.top+")");		
			
	var colorScale = d3.scale.quantile()
		.domain([0, (d3.max(dataset, function(d){return d.value;})/2), d3.max(dataset, function(d){return d.value;})])
		.range(colors);
		
	var heatMap = svg.selectAll(".hour")
		.data(dataset)
		.enter().append("rect")
		.attr("x", function(d,i) {return (i % blockCnt) * gridSize;})
		.attr("y", function(d,i){
			return Math.floor(i / blockCnt) * gridSize;			
		})
		.attr("rx", 4)
		.attr("ry", 4)
		.attr("class", "hour bordered")
		.attr("width", gridSize)
		.attr("height", gridSize)
		.style("fill", colors[0]).on('click',function(d){tabulate(oData,['Id','Flow','Status'], selectedKey, d.key, svg);});
		
	heatMap.transition().duration(1000)
		.style("fill", function(d){ return colorScale(d.value);});
		
	heatMap.append("title").text(function(d) {return d.key + " : " + d.value;});	

function tabulate(data, columns, selectedKey, selectedValue,context) {   
  d3.select('#table_data').html('');
  var table = d3.select('#table_data').append('table')
  var thead = table.append('thead')
  var tbody = table.append('tbody');

  // append the header row
  thead.append('tr')
    .selectAll('th')
    .data(columns).enter()
    .append('th')
      .text(function (column) { return column; });

  // create a row for each object in the data
  var rows = tbody.selectAll('tr')
    .data(oData.filter(function(d){
    return d[selectedKey] == selectedValue;
  }))
    .enter()
    .append('tr').attr('data-toggle','tooltip').attr('title',function(d){
      return d.Scenario;
    });

  // // create a cell in each row for each column
  var cells = rows.selectAll('td')
    .data(function (row) {                  
      return columns.map(function (column) {        
        return {column: column, value: row[column]};
      });
    })
    .enter()    
    .append('td')    
    .text(function (d) { return d.value; });

  return table;

}							
}