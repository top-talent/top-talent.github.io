var draw_forcegraph = function(data_index, json_source) {
    var width = 600,
        height = 500

    // initialize svg
    d3.selectAll('svg').remove();

    // append svg
    var svg = d3.select('#chart_section').append("svg")
        .attr("width", width)
        .attr("height", height);

    // append svg marker
    svg.append('svg:defs').append('svg:marker')
        .attr('id', 'end-arrow')
        .attr('viewBox', '0 -5 10 10')
        .attr('refX', 10)
        .attr('markerWidth', 5)
        .attr('markerHeight', 5)
        .attr('orient', 'auto')
        .append('svg:path')
        .attr('d', 'M0,-5L10,0L0,5')
        .attr('fill', '#000');

    var force = d3.layout.force()
        .gravity(0.03)
        .distance(200)
        .charge(-100)
        .size([width, height]);

    d3.json(json_source, function(error, json) {
        if (error) throw error;

        var nodes = json[0].graphContainers[data_index - 1].nodes;
        var links = json[0].graphContainers[data_index - 1].links;

        var tmp_nodes = nodes;
        var nodeNames = new Array();

        tmp_nodes.forEach(function(tmp_node) {
            nodeNames.push(tmp_node.uid);
        });

        links.forEach(function(link) {
            link.source = nodeNames.indexOf(link.sourceUid);
            link.target = nodeNames.indexOf(link.destinationUid);
        });

        force
            .nodes(nodes)
            .links(links)
            .start();

        var link = svg.selectAll(".link")
            .data(links)
            .enter().append("path")
            .attr("class", "link");

        var node = svg.selectAll(".node")
            .data(nodes)
            .enter().append("g")
            .attr("class", "node")
            .on("click", function(d) {
                d3.selectAll('.selected').classed('selected',false);
                d3.select(this).classed('selected',true);
                d3.select('#properties_section table').remove();

                var ts = d.properties;

                var properties_tbl = d3.select('#properties_section').append('table');
                var th = properties_tbl.append('thead').append('tr');
                th.append('th').text('keys');
                th.append('th').text('values');
                var keys = Object.keys(ts);

                var values = Object.values(ts);
                
                for(var i=0;i<keys.length;i++){
                    var row = properties_tbl.append('tr');
                    row.append('td').text(keys[i]);
                    row.append('td').text(values[i]);
                }
                
            })
            .call(force.drag);

        // add image based on data
        node.append("image")
            .attr("xlink:href", function(d) {
                return 'assets/' + d.type + '.png';
            })
            .attr("x", -16)
            .attr("y", -16)
            .attr("width", 32)
            .attr("height", 32);

        node.append("text")
            .attr("dx", 20)
            .attr("dy", 3)
            .text(function(d) {
                return d.label;
            });

    var edgepaths = svg.selectAll(".edgepath")
        .data(links)
        .enter()
        .append('path')
        .attr({'d': function(d) {var path='M '+d.source.x+' '+d.source.y+' L '+ d.target.x +' '+d.target.y;
                                           return path;},
               'class':'edgepath',
               'fill-opacity':0,
               'stroke-opacity':0,
               'fill':'blue',
               'stroke':'red',
               'id':function(d,i) {return 'edgepath'+i}})
        .style("pointer-events", "none");

    var edgelabels = svg.selectAll(".edgelabel")
        .data(links)
        .enter()
        .append('text')
        .style("pointer-events", "none")
        .attr({
            'class':'edgelabel',
            'id':function(d,i){return 'edgelabel'+i},
            'dx':80,
            'dy':-5,
            'font-size':10,
            'fill':'#aaa'});

    edgelabels.append('textPath')
        .attr('xlink:href',function(d,i) {return '#edgepath'+i})
        .style("pointer-events", "none")
        .text(function(d,i){return d.linkType;});

        // add links using <path> tag
        force.on("tick", function() {
            link.attr('d', function(d) {
                    var deltaX = d.target.x - d.source.x,
                        deltaY = d.target.y - d.source.y,
                        dist = Math.sqrt(deltaX * deltaX + deltaY * deltaY),
                        normX = deltaX / dist,
                        normY = deltaY / dist,
                        sourcePadding = 17,
                        targetPadding = 17,
                        sourceX = d.source.x + (sourcePadding * normX),
                        sourceY = d.source.y + (sourcePadding * normY),
                        targetX = d.target.x - (targetPadding * normX),
                        targetY = d.target.y - (targetPadding * normY);
                    return 'M' + sourceX + ',' + sourceY + 'L' + targetX + ',' + targetY;
                }).attr('id',function(d,i){
                    return 'link'+i;
                })
            // add arrow marker
                .style('marker-end', function(d) {
                    return 'url(#end-arrow)';
                });

            node.attr("transform", function(d) {
                return "translate(" + d.x + "," + d.y + ")";
            });

            edgepaths.attr('d', function(d) { 
                var path='M '+d.source.x+' '+d.source.y+' L '+ d.target.x +' '+d.target.y;
                return path
            });   

            edgelabels.attr('transform',function(d,i){
                if (d.target.x<d.source.x){
                    bbox = this.getBBox();
                    rx = bbox.x+bbox.width/2;
                    ry = bbox.y+bbox.height/2;
                    return 'rotate(180 '+rx+' '+ry+')';
                    }
                else {
                    return 'rotate(0)';
                    }
            });                    
        });


    });

}