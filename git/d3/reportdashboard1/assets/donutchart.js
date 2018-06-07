function donutChart(chartWrapper, dataset,oData,selectedKey) {
    var width = 960,
        height = 960,
        radius = Math.min(width, height - 100) / 2;

    var color = d3.scale.ordinal()
        .range(["green", "red", "orange", "#6b486b", "#a05d56"]);

    var arc = d3.svg.arc()
        .outerRadius(radius - 50)
        .innerRadius(radius - 100);

    var pie = d3.layout.pie()
        .sort(null)
        .startAngle(1.1 * Math.PI)
        .endAngle(3.1 * Math.PI)
        .padAngle(.02)
        .value(function(d) {
            return d.total;
        });
    var sum = 0;

    var svg = d3.select(chartWrapper).append("svg")
        .attr("width", '100%')
        .attr("height", '100%')
        .attr('viewBox', function() {
            return '0 0 ' + width + ' ' + height;
        })
        .append("g")
        .attr("transform", "translate(" + width / 2 + "," + parseInt(height / 2 + 70) + ")");
    
    var formatPercent = d3.format(",.2%");

    var tip = d3.tip()
        .attr('class', 'd3-tip')
        .offset([-10, 0])
        .html(function(d) {
            return "<strong>" + d.data.name + ": " + "</strong> <span style='color:red'>" + d.data.total + " / </span>" +""+" <span style='color:red'>" + formatPercent(d.data.total / sum) +"</span>";
        })
    
    dataset.forEach(function(d){
      type(d);
    });
    
    svg.call(tip);

    var g = svg.selectAll(".arc")
        .data(pie(dataset))
        .enter().append("g")
        .attr("class", "arc");

    var arc_path = g.append("path")
        .attr('class', 'arc_path')
        .style("fill", function(d) {
            return color(d.data.name);
        })

    arc_path.transition().delay(function(d, i) {
            return i * 500;
        }).duration(500)
        .attrTween('d', function(d) {
            var i = d3.interpolate(d.startAngle + 0.1, d.endAngle);
            return function(t) {
                d.endAngle = i(t);
                return arc(d)
            }
        })

    svg.selectAll('.arc_path').on('mouseover', function(d, i, j) {
            pathAnim(d3.select(this), 1);
            tip.show(d);
        })
        .on('mouseout', function(d, i, j) {
            var thisPath = d3.select(this);
            // if (!thisPath.classed('clicked')) {
                pathAnim(thisPath, 0);
            // }
            tip.hide(d);
        }).on('click', function(d, i, j) {
            // var thisPath = d3.select(this);
            // var clicked = thisPath.classed('clicked');
            // pathAnim(thisPath, ~~(!clicked));
            // thisPath.classed('clicked', !clicked);               
            tabulate(oData,['Id','Flow','Status'], selectedKey, d.data.name, svg);                            
        });
    // g.append("text")
    //     .attr("transform", function(d) { return "translate(" + arc.centroid(d) + ")"; })
    //     .attr("dy", ".35em")
    //  .transition()
    //  .delay(1000)
    //     .text(function(d) { return d.data.name; });


    //d3.select("body").transition().style("background-color", "#d3d3d3");    
    function type(d) {
        sum += d.total;                
    }

    var pathAnim = function(path, dir) {
        switch (dir) {
            case 0:
                path.transition()
                    .duration(500)
                    .ease('bounce')
                    .attr('d', d3.svg.arc()
                        .innerRadius((radius - 100))
                        .outerRadius(radius - 50)
                    );
                break;

            case 1:
                path.transition()
                    .attr('d', d3.svg.arc()
                        .innerRadius((radius - 100))
                        .outerRadius((radius - 50) * 1.08)
                    );
                break;
        }
    }

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

