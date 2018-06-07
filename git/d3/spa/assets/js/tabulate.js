var table = d3.select('#tbl_section').append('table')
var thead = table.append('thead')
var tbody = table.append('tbody');

var dropdown = d3.select("#json_sources")
var change = function() {
	//get json based on dropdown change event
    var source = dropdown.node().options[dropdown.node().selectedIndex].value;
    d3.json(source, function(json_data) {
        var data = json_data[0].data;

        //define columnNames to display table headers
        var columnNames = json_data[0].columnNames;
        // columnNames = columnNames.slice(0, 5);

        function tabulate(data, columns) {

            d3.selectAll('tr').remove();
            // append the header row
            thead.append('tr')
                .selectAll('th')
                .data(columns).enter()
                .append('th')
                .text(function(column) {
                    return column;
                });

            // create a row for each object in the data
            var rows = tbody.selectAll('tr')
                .data(data)
                .enter()
                .append('tr')
                .on('click', function(d) {
                    var data_index = findChildIndex(this);
                    d3.selectAll('tr').classed('active', false);
                    d3.select(this).classed('active', true);
                    draw_forcegraph(data_index, source);
                });

            // create a cell in each row for each column
            var cells = rows.selectAll('td')
                .data(function(row) {
                    return columns.map(function(column) {
                        var tmp_index = columnNames.indexOf(column);
                        return {
                            column: column,
                            value: row[tmp_index]
                        };
                    });
                })
                .enter()
                .append('td')
                .text(function(d) {
                    return d.value;
                });

            return table;
        }

        // render the table(s)
        tabulate(data, columnNames);
    })
}

//get nth child number of selected element
function findChildIndex(node) {
    var index = 1;
    while (node.previousSibling) {
        node = node.previousSibling;
        if (node && node.nodeType === 1) { // 1 = element
            ++index;
        }
    }
    return index;
}

//initialize
dropdown.on("change", change)
change();