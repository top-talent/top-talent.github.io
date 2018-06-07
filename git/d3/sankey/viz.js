var margin = {top: 50, right: 10, bottom: 10, left: 80},
    width = 1200 - margin.left - margin.right,
    height = 840 - margin.top - margin.bottom;

var units = "points";
var formatNumber = d3.format(",.0f"),    // zero decimal places
    format = function(d) { return formatNumber(d) + " " + units; },
    color = d3.scale.category20();

  /* Initialize tooltip */
  var tipLinks = d3.tip()
      .attr('class', 'd3-tip')
      .offset([-10,0])
      .html(function(d){
        return d.source.name + " - " + d.target.name + " - " + format(d.value);
      });

  var tipNodes = d3.tip()
      .attr('class', 'd3-tip d3-tip-nodes')
      .offset([-10, 0])
      .html(function(d){
      	return d.name + " - " + format(d.value);
      });  

// append the svg to the page.
var svg = d3.select("body").append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.top + margin.bottom)
		.attr("class","sankey")
		.call(tipLinks)
    .call(tipNodes)
		.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")"); 

// set the sankey diagram properties.
var sankey = d3.sankey()
		.nodeWidth(36)
		.nodePadding(10)
		.size([width, height]);

var path = sankey.link();

// load the data.
d3.queue(1)
	.defer(d3.csv, 'races.csv')
	.defer(d3.csv, 'teams.csv')
	.await(grandprix); 
// get the data from the csv.
function grandprix(error, races, teams){

	var raceteam = [];
	var teamunique = [];
	teams.forEach(function(d){
		raceteam.push(d.team);
			teamunique = raceteam.filter(function(elem, index, self) {
	    	return index == self.indexOf(elem);
			});
	});
	// made graph's node and links. 
	var graph = {"nodes" : [], "links" : []};
	var datas = [];
	races.forEach(function(d){
    datas.push({"name": d.race});
    datas.push({"name": d.driver});
		graph.links.push({"source": d.race, "target":d.driver, "value": d.points});
	});

	teams.forEach(function(d){
		datas.push({"name": d.team});
		graph.links.push({"source": d.driver, "target": d.team, "value": d.points});
	});
// remove duplicate data in the node array.
var reduce = function(arr, prop) {
  var result = [],
      filterVal,
      filters,
      filterByVal = function(n) {
          if (n[prop] === filterVal) return true;
      };
  for (var i = 0; i < arr.length; i++) {
      filterVal = arr[i][prop];
      filters   = result.filter(filterByVal);
      if (filters.length === 0) result.push(arr[i]);
  }
  return result;
};

graph.nodes = reduce(datas, "name");
  var nodeMap = {};

  graph.nodes.forEach(function(x) { nodeMap[x.name] = x; });
  graph.links = graph.links.map(function(x) {
    return {
      source: nodeMap[x.source],
      target: nodeMap[x.target],
      value: x.value
    };
  });

	sankey.nodes(graph.nodes)
		.links(graph.links)
		.layout(32);
	// add in the links
  var link = svg.append("g").selectAll(".link")
      .data(graph.links)
    .enter().append("path")
      .attr("class", "link")
      .attr("d", path)
      .style("stroke-width", function(d) { return Math.max(1, d.dy); })
      .sort(function(a, b) { return a.dy - b.dy; })
      .on("mouseover", tipLinks.show)
      .on("mouseout", tipLinks.hide);

// add in the nodes
  var node = svg.append("g").selectAll(".node")
      .data(graph.nodes)
    .enter().append("g")
      .attr("class", "node")
      .attr("transform", function(d) { 
      return "translate(" + d.x + "," + d.y + ")"; })
    .call(d3.behavior.drag()
      .origin(function(d) { return d; })
      .on("dragstart", function() { 
      this.parentNode.appendChild(this); })
      .on("drag", dragmove));
 
// add the rectangles for the nodes
  node.append("rect")
      .attr("height", function(d) { return d.dy + 1; })
      .attr("width", sankey.nodeWidth())
      .style("fill", function(d) { 
      	return d.color = color(d.name.replace(/ .*/, "")); })
      .style("stroke", function(d) { 
      	return d3.rgb(d.color).darker(2); })
      .on("mouseover", tipNodes.show)
      .on("mouseout", tipNodes.hide);
      
// add in the title for the nodes
  node.append("text")
      .attr("x", -6)
      .attr("y", function(d) { return d.dy / 2; })
      .attr("dy", ".35em")
      .attr("text-anchor", "end")
      .attr("transform", null)
      .text(function(d) { return d.name; })
    .filter(function(d) { return d.x < width / 2; })
      .attr("x", 6 + sankey.nodeWidth())
      .attr("text-anchor", "start");
 
// the function for moving the nodes
  function dragmove(d) {
    d3.select(this).attr("transform", 
        "translate(" + (
             d.x = Math.max(0, Math.min(width - d.dx, d3.event.x))
          ) + "," + (
                   d.y // = Math.max(0, Math.min(height - d.dy, d3.event.y))
            ) + ")");
    sankey.relayout();
    link.attr("d", path);
  }

}	

