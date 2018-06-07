//Append svg
var svg = d3.select("#content").append("svg")
    .attr('width', '100%')
    .attr('height', '100%')
    .attr('viewBox', '0 0 970 570')
    .attr('preserveAspectRatio', 'xMinYMin')
    .append("g")
    .attr("transform", "translate(30,10)");

var width = 970 - 30;
var height = 570 - 10;

//define global variables
var defColor = '#337ab7';
var priColor = '#f0ad4e';
var totalItemsCnt = 0;
var depth = 0;
var defElWidth = 100;
var defElHeight = 40;
var linkWidth = 50;
var currentStep = 1;
var padding = 5;
var nextX = 0;
var nextY = 40;
var itemsData = [];
var drawedItemsArray = [];
var defStreamHeight = 0;
var paddingY = 40;
var junctionOperatorRadius = 20;
var rhombusRadius = 50;

d3.json('assets/jsondata2.json', function(data) {
    drawStreamLayout(data[0]);
    itemsData = data[0].items;
    parseJson(itemsData);
    drawElement(10, paddingY, itemsData[currentStep], currentStep);
    drawLinks(itemsData);
})

//draw rectangle
function drawRect(id, x, y, width, height, color, text) {
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + width).attr('endY', y + height);
    var res = g.append("rect")
        .attr("x", 0)
        .attr("y", 0)
        .attr("width", width)
        .attr("height", height)
        .attr('stroke', color);

    res += g.append("text").text(text).attr('x', width / 2).attr('y', height / 2).attr('text-anchor', 'middle').attr('dy', '.1em').call(wrap, width);
}

//draw rounded rectangle
function drawRoundRect(id, x, y, width, height, text, color, rx) {
    if (rx == '' || rx == undefined) {
        rx = 3;
    }
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + width).attr('endY', y + height);
    var res = g.append("rect")
        .attr('ry', rx)
        .attr("x", 0)
        .attr("y", 0)
        .attr("width", width)
        .attr("height", height)
        .attr('stroke', color);
    res += g.append("text").text(text).attr('x', width / 2).attr('y', height / 2).attr('text-anchor', 'middle').attr('dy', '.1em').call(wrap, width);

}

//draw round square and rotate
function drawRhombus(id, x, y, width, color, rx, text) {
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + 2 * width).attr('endY', y + width);
    var res = g.append("polygon")
        .attr('points', function() {
            return 0 + ',' + defElHeight / 2 + ' ' + width + ',' + (-width + defElHeight / 2) + ' ' + (2 * width) + ',' + defElHeight / 2 + ' ' + width + ',' + (width + defElHeight / 2)
        })
        .attr('stroke', color)
        .attr('fill', 'white');

    res += g.append("text").text(text).attr('x', width).attr('y', defElHeight / 2).attr('text-anchor', 'middle').attr('dy', '.1em').call(wrap, width);
    return res;
}

function drawOrSplitOperator(id, x, y, color, rx) {
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + rx).attr('endY', y + rx);
    g.append("circle")
        .attr('r', rx)
        .attr("cx", rx)
        .attr("cy", rx)
        .attr('stroke', color);
    g.append('line')
        .attr('x1', 0)
        .attr('y1', rx)
        .attr('x2', (2 * rx))
        .attr('y2', (rx))
        .attr('stroke', defColor)
        .attr('stroke-width', '3px');

    g.append('line')
        .attr('x1', rx)
        .attr('y1', 0)
        .attr('x2', rx)
        .attr('y2', 2 * rx)
        .attr('stroke', defColor)
        .attr('stroke-width', '3px');
}

function drawJunctionOperator(id, x, y, color, rx) {
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + 2 * rx).attr('endY', y + rx);
    g.append("circle")
        .attr('r', rx)
        .attr("cx", rx)
        .attr("cy", rx)
        .attr('stroke', color);
    g.append('line')
        .attr('x1', 5)
        .attr('y1', 5)
        .attr('x2', (2 * rx - 5))
        .attr('y2', (2 * rx - 5))
        .attr('stroke', defColor)
        .attr('stroke-width', '3px');

    g.append('line')
        .attr('x1', 5)
        .attr('y1', (2 * rx - 5))
        .attr('x2', (2 * rx - 5))
        .attr('y2', 5)
        .attr('stroke', defColor)
        .attr('stroke-width', '3px');
}

function drawConnectorOperator(id, x, y, color, rx, text) {
    var g = svg.append('g').attr('id', 'item' + id).attr('class', 'g_wrapper').attr('transform', function() {
        return "translate(" + x + "," + y + ")";
    }).attr('startX', x).attr('startY', y).attr('endX', x + 2 * rx).attr('endY', y + rx);
    g.append("circle")
        .attr('r', rx)
        .attr("cx", rx+10)
        .attr("cy", rx / 2)
        .attr('stroke', color);
    g.append("text").text(text).attr('x', rx+10).attr('y', rx / 2).attr('text-anchor', 'middle').attr('dy', '.1em').call(wrap, 2 * rx);
}

//Default left-right arrow
function drawArrow(x, y, nX, nY, nodeType) {
    var qVH = 3;
    var ahwidth = 5;
    switch (nodeType) {
        case 'start':
            x += defElWidth;
            y += defElHeight / 2;
            break;
        case 'finish':
            x += defElWidth;
            y += defElHeight / 2;
            break;
        case 'decision':
            x += 2 * rhombusRadius;
            y += defElHeight / 2;
            break;
        case 'process-simple':
            x += defElWidth;
            y += defElHeight / 2;
            break;
        case 'junction':
            x += 2 * junctionOperatorRadius;
            y += defElHeight / 2;
            break;
        case 'or-split':
            x += 2 * junctionOperatorRadius;
            y += defElHeight / 2;
            break;
    }

    return "M" + x + "," + y +
        "h" + (nX - x - ahwidth) +
        "v" + (-qVH) +
        "L" + (nX) + ',' + y +
        "L" + (nX - ahwidth) + ',' + (parseInt(y) + qVH) +
        "v" + (-qVH);
}

/*
|-------|
|       |
V       |
*/
function drawArrow4(startX, startY, endX, endY) {
    startX += defElWidth / 2;
    return "M" + startX + "," + startY +
        "v" + (-35) +
        "h" + -(startX - endX - 20) +
        "v" + 25 +
        "h" + 5 +
        "L" + (endX + 20) + ',' + (endY) +
        "L" + (endX + 15) + ',' + (endY - 10) +
        "h" + (5);
}
//Arrow - Decision to Vertical Element
function drawArrow2(startX, startY, endX, endY, type,nextType) {
    var diffElHeight = 40;
    startX += 50;
    if (type == 'decision') {
        startY += 70;        
    } else if(type=="process-simple" || type=='start' || type=="finish"){
        startY += 40;
    }else if(type=='connector-start'){

    }

    if(nextType == 'decision'){
        diffElHeight = 70;           
    }else if(nextType=='process-simple' || nextType=='start' || nextType=="finish"){
        diffElHeight = 10;
    }else if(nextType=='connector-start'||nextType=="connector-end"){
        diffElHeight = 50;
    }
    return "M" + startX + "," + startY +
        "v" + (endY - startY - diffElHeight / 2 ) +
        "h" + 5 +
        "L" + (startX) + ',' + (endY - diffElHeight / 2 + 5) +
        "L" + (startX - 5) + ',' + (endY - diffElHeight / 2) +
        "h" + (5);
}

//Arrow - bottom to top left
function drawArrow3(startX, startY, endX, endY) {
    var qVH = 3;
    endX += junctionOperatorRadius;
    startY += defElHeight / 2;
    endY += 2 * junctionOperatorRadius + 8;
    return "M" + startX + "," + startY +
        "h" + (endX - startX) +
        "v" + (endY - startY) +
        "h" + (-5) +
        "L" + (endX) + ',' + (endY - 5) +
        "L" + (endX + 5) + ',' + (endY) +
        "h" + (-5);
}

function wrap(text, width) {
    text.each(function() {
        var text = d3.select(this),
            words = text.text().split(/\s+/).reverse(),
            word,
            line = [],
            lineNumber = 0,
            lineHeight = 1.1, // ems
            y = text.attr("y"),
            x = text.attr('x'),
            dy = parseFloat(text.attr("dy")),
            tspan = text.text(null).append("tspan").attr("x", x).attr("y", y).attr("dy", dy + "em");
        while (word = words.pop()) {
            line.push(word);
            tspan.text(line.join(" "));
            if (tspan.node().getComputedTextLength() > width) {
                line.pop();
                tspan.text(line.join(" "));
                line = [word];
                tspan = text.append("tspan").attr("x", x).attr("y", y).attr("dy", ++lineNumber * lineHeight + dy + "em").text(word);
            }
        }
    });
}

function parseJson(jsondata) {
    totalItemsCnt = Object.keys(jsondata).length;
    var connectorsArray = [];
    for (index in jsondata) {
        connectorsArray.push(Object.keys(jsondata[index].connectors).length);
    }
    depth = d3.max(connectorsArray);
    defElWidth = width / (totalItemsCnt - depth + 1) - linkWidth;
}

function selectArrow(startX, startY, endX, endY, nodeType,nextType) {
    if (startY == endY) {
        if (endX < startX) {
            return drawArrow4(startX, startY, endX, endY);
        } else {
            return drawArrow(startX, startY, endX, endY, nodeType);
        }
    }

    if (startX == endX) {
        return drawArrow2(startX, startY, endX, endY, nodeType,nextType);
    }

    if ((endX < startX) && (endY < startY)) {
        return drawArrow3(startX, startY, endX, endY);
    }
}

function drawElement(startX, startY, data, step) {
    drawedItemsArray.push(step);
    // step++;        
    switch (data.type) {
        case 'start':
            drawRoundRect(data.id, startX, startY, defElWidth, 40, data.title, defColor);
            break;
        case 'finish':
            drawRoundRect(data.id, startX, startY, defElWidth, 40, data.title, priColor);
            break;
        case 'process-simple':
            drawRect(data.id, startX, startY, defElWidth, 40, defColor, data.title);
            break;
        case 'decision':
            drawRhombus(data.id, startX, startY, rhombusRadius, defColor, 5, data.title);
            break;
        case 'connector-start':
            drawConnectorOperator(data.id, startX, startY, defColor, 40, data.title)
            break;
        case 'connector-end':
            drawConnectorOperator(data.id, startX, startY, priColor, 40, data.title)
            break;
        case 'or-split':
            drawOrSplitOperator(data.id, startX, startY, defColor, 20);
            break;
        case 'junction':
            drawJunctionOperator(data.id, startX, startY, defColor, 20);
            break;
        default:
            break;
    }
    
    if (Object.keys(data.connectors).length == 1) {
        var tmpConnector = data.connectors[1];
        nextStep = tmpConnector.linkTo;
        nextItemData = itemsData[nextStep];
        if (data.stream == nextItemData.stream) {
            nextX = startX + defElWidth + linkWidth + padding;
            nextY = startY;
        } else {
            nextX = startX;
            nextY = defStreamHeight * (nextItemData.stream - 1) + paddingY;
        }

        if (drawedItemsArray.indexOf(nextStep) == -1) {
            drawElement(nextX, nextY, nextItemData, nextStep);
        }
    }

    if (Object.keys(data.connectors).length == 2) {
        //1st node
        var tmpConnector = data.connectors[1];
        nextStep = tmpConnector.linkTo;
        nextItemData = itemsData[nextStep];
        if (data.stream == nextItemData.stream) {
            nextX = startX + defElWidth + linkWidth + padding;
            nextY = startY;
        } else {
            nextX = startX;
            nextY = defStreamHeight * (nextItemData.stream - 1) + paddingY;
        }

        if (drawedItemsArray.indexOf(nextStep) == -1) {
            drawElement(nextX, nextY, nextItemData, nextStep);
        }

        //2nd node
        var tmpConnector = data.connectors[2];
        nextStep = tmpConnector.linkTo;
        nextItemData = itemsData[nextStep];
        if (data.stream == nextItemData.stream) {
            nextX = startX;
            nextY = startY + 120;
        } else {
            nextX = startX;
            nextY = defStreamHeight * (nextItemData.stream - 1) + paddingY;
        }

        if (drawedItemsArray.indexOf(nextStep) == -1) {
            drawElement(nextX, nextY, nextItemData, nextStep);
        }
    }
}

function drawLinks(itemsData) {
    for (index in itemsData) {
        for (connector in itemsData[index].connectors) {
            var fromId = itemsData[index].id;
            startX = d3.select('#item' + fromId).attr('startX');
            startY = d3.select('#item' + fromId).attr('startY');
            var toId = itemsData[index].connectors[connector].linkTo;
            endX = d3.select('#item' + toId).attr('startX');
            endY = d3.select('#item' + toId).attr('startY');
            var nodeType = itemsData[index].type;
            var nextType = itemsData[toId].type;            
            svg.append('path').attr("d", selectArrow(parseInt(startX), parseInt(startY), parseInt(endX), parseInt(endY), nodeType,nextType)).attr("fill", "none");
            
            appendLinkTitle(itemsData[index].connectors[connector].title,startX,startY,endX,endY);            
        }
    }
}

function appendLinkTitle(text,startX,startY,endX,endY){    
    var poX,poY;
    poY  = endY;
    poX  = endX - 25;
    var textWidth = 50;
    var textAnchor = 'middle';
    if (startY == endY) {
        if (endX < startX) {
            poY = parseInt(endY);
            poX = startX - 50;
        } else {
            poY = parseInt(endY) + 30;
        }
    }

    if (startX == endX) {
        poY = endY - (endY-startY)/2 + rhombusRadius;
        poX = parseInt(endX)+50;
        textWidth = 150;
        textAnchor = 'end';
    }

    if ((endX < startX) && (endY < startY)) {
        poY = endY - (endY-startY)/2;
    }

    svg.append('text').attr('x',poX).attr('dx','-5px').attr('dy','-3px').attr('y',poY).style('text-anchor',textAnchor).text(text).style('font-size','8px').call(wrap,textWidth);
}
function drawStreamLayout(data) {
    var streamsData = data.streams;
    var streamsCnt = Object.keys(streamsData).length;

    defStreamHeight = height / streamsCnt;
    var streamsArr = [];
    for (stream in streamsData) {
        streamsArr.push({
            'id': streamsData[stream].id,
            'order': streamsData[stream].order,
            'title': streamsData[stream].title
        })
    };

    var g_stream_wrapper = svg.selectAll(".stream")
        .data(streamsArr)
        .enter().append('g').attr('class', 'stream_wrapper');

    g_stream_wrapper
        .append("rect")
        .attr("class", "stream")
        .attr("x", 0)
        .attr("y", function(d, i) {
            return height / streamsCnt * i
        }).attr('rx', 6).attr('width', width).attr('height', function(d, i) {
            return height / streamsCnt;
        }).attr('fill', 'none').attr('stroke', '#ddd').attr('stroke-width', '2px');

    g_stream_wrapper.append('text')
        .attr('x', function(d, i) {
            return -height / streamsCnt * i
        })
        .attr('y', 0)
        .style("text-anchor", "end")
        .attr("dx", "-3.5em")
        .attr("dy", "-.55em")
        .attr("transform", "rotate(-90)").text(function(d) {
            return d.title
        });
}