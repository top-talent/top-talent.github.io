var margin = {top: 30, left:40, right:100, bottom:50},
	width = 960 - margin.left - margin.right,
	height = 700 - margin.top - margin.bottom,
    gridsize = Math.floor(width/12),
    dim_1 = ["Baratheon","Greyjoy","Lannister","Martell","Stark","Targaryen","Tyrell"],
    dim_2 = [1,2,3,4,5,6,7,8,9,10],
    buckets = 10;
    // YlGnBu color.
    var YlGnBu={
        3:["#edf8b1","#7fcdbb","#2c7fb8"],
        4:["#ffffcc","#a1dab4","#41b6c4","#225ea8"],
        5:["#ffffcc","#a1dab4","#41b6c4","#2c7fb8","#253494"],
        6:["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#2c7fb8","#253494"],
        7:["#ffffcc","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"],
        8:["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#0c2c84"],
        9:["#ffffd9","#edf8b1","#c7e9b4","#7fcdbb","#41b6c4","#1d91c0","#225ea8","#253494","#081d58"]
    };
// add svg to the body.
var svg = d3.select("body #svg").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform", "translate(" + 170 + "," + margin.top + ")");

var val = [];  
// get the data from csv.
d3.csv("heatmap.csv", function(error,data){
	if(error) throw error;
    // get the data when opened firstly.
        val = data.filter(function(row){
            return row.season == "1";
        });
        for(var i=0; i< data.length; i++){
            if(data[i].season == "1"){
                val.push(data[i]);
            }
        }
        // color legend.
        colors = YlGnBu[9];
        var maxNum = d3.max(data, function(d){ return d.episode;});
        var colorscale = d3.scale.quantile().domain([0, buckets-1, maxNum]).range(colors);

        // add x axis value to the svg.
        var dim1label = svg.append("g")
            .attr("class", "dim1");
        svg.selectAll(".dim1labelss").remove();
        svg.selectAll(".label1").remove();
        dim1label.append("text")
            .attr("class", "label1")
            .attr("x", -10)
            .attr("y", 1)
            .attr("dy", -10)
            .style("text-anchor", "end")
            .style("font-size", 20)
            .style("font-weight", "bold")
            .text("House");

        var dim1Labels = dim1label.selectAll(".dim1labelss")
            .data(dim_1)
            .enter()
            .append("text")
            .text(function(d){ return d;})
            .attr("x", 0)
            .attr("y", function(d, i){ return i * gridsize;})
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridsize/1.5 + ")")
            .attr("class","dim1labelss");   

        // add y axis value to the svg.
        var dim2label = svg.append("g")
            .attr("class", "dim2");

        svg.selectAll(".dim2label").remove();
        svg.selectAll(".label2").remove();
        dim2label.append("text")
            .attr("class", "label2")
            .attr("x", gridsize * 11)
            .attr("y", gridsize * 7.5)
            .attr("dy", -5)
            .style("text-anchor", "end")
            .style("font-size", 20)
            .style("font-weight", "bold")
            .text("Episode");
        var dim2Labels = dim2label.selectAll(".dim2label")
            .data(dim_2)
            .enter().append("text")
            .text(function(d){return d;})
            .attr("x",function(d, i){ return i * gridsize;})
            .attr("y", gridsize * 7.5)
            .style("text-anchor", "middle")
            .attr("transform", "translate(" + gridsize/2 +  "," + (-6) + ")")
            .attr("class", "dim2label");

        // add blocks to the svg.
        svg.selectAll(".square").remove(); 
        var heatmap = svg.append("g")
            .attr("class", "dim");
        getcolor = changedata(val);    
        for(var i = 0; i< dim_2.length; i++){
            for(var j = 0; j<dim_1.length; j++){

                heatmap.append("rect")
                .attr("x", function(d){ return i * gridsize})
                .attr("y", function(d){ return j * gridsize})
                .attr("rx", 4)
                .attr("ry", 4)
                .attr("class", "square")
                .attr("width", gridsize - 2)
                .attr("height", gridsize - 2)
                .style("fill", getcolor[i][j])
                .attr("class", "square");
            }
        };   
        // legend colorstep.

        var colorstep = colorsteps(val);
        // legend add to the svg.
        var legend = svg.append("g")
            .attr("class", "legend")
            .attr("transform", "translate(0,550)");   
        svg.selectAll(".legendtext").remove();
        svg.selectAll("colorstep").remove();
        svg.selectAll(".legendval").remove();    
        legend.append("text")
            .attr("class", "legendtext")
            .text("No of Appearances");   
        legend.selectAll(".colorstep")
            .data(colorstep)
            .enter().append("rect")
            .attr("class","colorstep")    
            .attr("x", function(d,i){ return i * 70;})
            .attr("y", 20)
            .attr("width","70")
            .attr("height", "20")
            .style("fill",function(d, i){;return colors[i];})
            .style("stroke", "#000");
        legend.selectAll(".legendval")
            .data(colorstep)
            .enter().append("text")
            .attr("class","legendval")
            .attr("text-anchor", "start")
            .attr("x",function(d,i){return i * 70;})
            .attr("y",18)
            .text(function(d){return d;});     
   

    // get the data when change the select option. 
    d3.select("#season").on("change", change);
    function change(){
        sel = d3.select(this).property("value");
        val = data.filter(function(row){
            return row.season == sel;
        });
        for(var i=0; i< data.length; i++){
            if(data[i].season == season){
                val.push(data[i]);
            }
        }

        // color legend.
        colors = YlGnBu[9];
        var maxNum = d3.max(data, function(d){ return d.episode;});
        var colorscale = d3.scale.quantile().domain([0, buckets-1, maxNum]).range(colors);

        // add x axis value to the svg.
        var dim1label = svg.append("g")
            .attr("class", "dim1");
        svg.selectAll(".dim1labelss").remove();
        svg.selectAll(".label1").remove();
        dim1label.append("text")
            .attr("class", "label1")
            .attr("x", -10)
            .attr("y", 1)
            .attr("dy", -10)
            .style("text-anchor", "end")
            .style("font-size", 20)
            .style("font-weight", "bold")
            .text("House");

        var dim1Labels = dim1label.selectAll(".dim1labelss")
            .data(dim_1)
            .enter()
            .append("text")
            .text(function(d){ return d;})
            .attr("x", 0)
            .attr("y", function(d, i){ return i * gridsize;})
            .style("text-anchor", "end")
            .attr("transform", "translate(-6," + gridsize/1.5 + ")")
            .attr("class","dim1labelss");   

        // add y axis value to the svg.
        var dim2label = svg.append("g")
            .attr("class", "dim2");

        svg.selectAll(".dim2label").remove();
        svg.selectAll(".label2").remove();
        dim2label.append("text")
            .attr("class", "label2")
            .attr("x", gridsize * 11)
            .attr("y", gridsize * 7.5)
            .attr("dy", -5)
            .style("text-anchor", "end")
            .style("font-size", 20)
            .style("font-weight", "bold")
            .text("Episode");
        var dim2Labels = dim2label.selectAll(".dim2label")
            .data(dim_2)
            .enter().append("text")
            .text(function(d){return d;})
            .attr("x",function(d, i){ return i * gridsize;})
            .attr("y", gridsize * 7.5)
            .style("text-anchor", "middle")
            .attr("transform", "translate(" + gridsize/2 +  "," + (-6) + ")")
            .attr("class", "dim2label");

        // add blocks to the svg.
        svg.selectAll(".square").remove(); 
        var heatmap = svg.append("g")
            .attr("class", "dim");
        getcolor = changedata(val);    
        for(var i = 0; i< dim_2.length; i++){
            for(var j = 0; j<dim_1.length; j++){

                heatmap.append("rect")
                .attr("x", function(d){ return i * gridsize})
                .attr("y", function(d){ return j * gridsize})
                .attr("rx", 4)
                .attr("ry", 4)
                .attr("class", "square")
                .attr("width", gridsize - 2)
                .attr("height", gridsize - 2)
                .style("fill", getcolor[i][j])
                .attr("class", "square");
            }
        }   

        // colorstep.
        var colorstep = colorsteps(val);
        // legend add to the svg.
        var legend = svg.append("g")
            .attr("class", "legend")
            .attr("transform", "translate(0,550)");   
        svg.selectAll(".legendtext").remove();
        svg.selectAll("colorstep").remove();
        svg.selectAll(".legendval").remove();    
        legend.append("text")
            .attr("class", "legendtext")
            .text("No of Appearances");   
        legend.selectAll(".colorstep")
            .data(colorstep)
            .enter().append("rect")
            .attr("class","colorstep")    
            .attr("x", function(d,i){ return i * 70;})
            .attr("y", 20)
            .attr("width","70")
            .attr("height", "20")
            .style("fill",function(d, i){return colors[i];})
            .style("stroke", "#000");
        legend.selectAll(".legendval")
            .data(colorstep)
            .enter().append("text")
            .attr("class","legendval")
            .attr("text-anchor", "start")
            .attr("x",function(d,i){return i * 70;})
            .attr("y",18)
            .text(function(d){return d;});     
        }   
});

function colorselect(data, divide){
    var colorval = "";
    if(data >= 0 && data < divide){
        colorval = "#ffffd9";
    }else if(data >= divide && data < divide * 2){
        colorval = "#edf8b1";
    }else if(data >=divide * 2 && data < divide * 3){
        colorval = "#c7e9b4";
    }else if(data >=divide * 3 && data < divide * 4){
        colorval = "#7fcdbb";
    }else if(data>= divide * 4 && data < divide * 5){
        colorval = "#41b6c4";
    }else if(data >= divide * 5 && data < divide * 6){
        colorval = "#1d91c0";
    }else if(data >=divide * 6 && data < divide * 7){
        colorval = "#225ea8";
    }else if(data >=divide * 7 && data < divide * 8){
        colorval = "#253494";
    }else if(data >= divide * 8){
        colorval = "#081d58";
    }
    return colorval;
};

function colorsteps(val){
    var datas = [];
    var maxdata = 0;
    var md = [];
    for(var i = 0; i< val.length; i++){
        v1 = parseInt(val[i].Baratheon);
        v2 = parseInt(val[i].Greyjoy);
        v3 = parseInt(val[i].Lannister);
        v4 = parseInt(val[i].Martell);
        v5 = parseInt(val[i].Stark);
        v6 = parseInt(val[i].Targaryen);
        v7 = parseInt(val[i].Tyrell);
        md.push(v1,v2,v3,v4,v5,v6,v7);
    }
    maxdata = Math.max.apply(null, md);
    console.log(maxdata);
    var divide = Math.round(maxdata/9); 
    console.log(divide);
    colordata = [0, divide, divide * 2, divide * 3, divide * 4, divide * 5, divide * 6, divide * 7, divide * 8];
    return colordata;
}

function changedata(val){
    var datas = [];
    var maxdata = 0;
    var md = [];
    for(var i = 0; i< val.length; i++){
        v1 = parseInt(val[i].Baratheon);
        v2 = parseInt(val[i].Greyjoy);
        v3 = parseInt(val[i].Lannister);
        v4 = parseInt(val[i].Martell);
        v5 = parseInt(val[i].Stark);
        v6 = parseInt(val[i].Targaryen);
        v7 = parseInt(val[i].Tyrell);
        md.push(v1,v2,v3,v4,v5,v6,v7);
    }
    maxdata = Math.max.apply(null, md);
    var divide = Math.floor(maxdata/9);    

    for(var i = 0; i<val.length; i++){
        datas[i] = new Array();
        datas[i][0] = colorselect(val[i].Baratheon, divide);
        datas[i][1] = colorselect(val[i].Greyjoy, divide);
        datas[i][2] = colorselect(val[i].Lannister, divide);
        datas[i][3] = colorselect(val[i].Martell, divide);
        datas[i][4] = colorselect(val[i].Stark, divide);
        datas[i][5] = colorselect(val[i].Targaryen, divide);
        datas[i][6] = colorselect(val[i].Tyrell, divide);
    }
    var dt = "";
    for( var j = 0; j<7; j++){
        dt = datas[1][j];
        datas[1][j] = datas[2][j];
        datas[2][j] = datas[3][j];
        datas[3][j] = datas[4][j];
        datas[4][j] = datas[5][j];
        datas[5][j] = datas[6][j];
        datas[6][j] = datas[7][j];
        datas[7][j] = datas[8][j];
        datas[8][j] = datas[9][j];
        datas[9][j] = dt;
    }
    return datas;
}

