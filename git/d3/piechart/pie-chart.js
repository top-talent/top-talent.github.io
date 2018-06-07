let currentDay;

let pieChart = {
  container: '#pie-container',
  isLoading: false,
  svg: '',
  width: 300,
  height: 300,
  proportion: 1,
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  colors: ["#697ec5", "#6597a6", "#c56373", "#ffc860", "#5EF3A2", "#80C2FF", "#806b86"],
  colorsBrighten: ["#3958c5", "#00527e", "#c52d47", "#ff8f2b", "#29f363", "#1eb4ff", "#5d308a"],

  draw: function(data) {

    let radius = this.width*0.5 - 60;

    this.svg.append('text')
      .attr("transform",`translate(${this.width/2 + 30}, 20)`)
      .text('Avg. advertisments in day');

    let g = this.svg.append('g')
      .attr('transform', `translate(${this.width/2 + 30}, ${(this.height+30)/2})`)
      .style('stroke', 'white');

    g.append('circle')
      .attr('r', radius)
      .attr('cx', 0)
      .attr('cy', 0)
      .style('fill', 'black')
      .style('stroke', 'transparent')
      .style('opacity', .25);

    let pie = d3.pie()
      .sort(null);

    let path = d3.arc()
      .innerRadius(0)
      .outerRadius(radius);

    let arc = g.selectAll('.arc')
      .data(pie(data.days))
      .enter()
      .append('g')
      .classed('arc', true)
      .style('cursor', 'pointer');

    arc.append('path')
      .attr('d', path)
      .style('fill', (d, i) => { return this.colors[i]; })
      .style('stroke', 'transparent');

    path.outerRadius(radius*1.4);

    arc.append('text')
      .classed('weekday', true)
      .attr("transform",(d) => { return `translate(${path.centroid(d)})`; })
      .attr('font-size', '10px')
      .attr("dy", ".35em")
      .text((d, i) => { return this.labels[i].toUpperCase(); });

    this.svg.selectAll('text')
      .attr('text-anchor', 'middle')
      .style('fill', 'white');

    path.outerRadius(radius*0.6);

    arc.append('text')
      .classed('num', true)
      .attr("transform",(d) => { return `translate(${path.centroid(d)})`; })
      .attr('font-weight', 900)
      .attr('font-size', '16px')
      .attr('text-anchor', 'middle')
      .attr("dy", ".35em")
      .style('stroke', 'transparent')
      .style('fill', 'black')
      .style('opacity', 0)
      .text((d, i) => { return data.days[i]; });

    arc.on('mouseenter', (ev, i)=> {
      let selectedArc = this.svg.select(`.arc:nth-of-type(${i + 1})`);

      path.outerRadius(30);

        selectedArc.select('path')
        .transition()
        .attr("transform",(d) => { return `translate(${path.centroid(d)})`; })
        .style('fill', this.colorsBrighten[i]);

      path.outerRadius(radius*1.4 + 30);

        selectedArc.select('.weekday')
          .transition()
          .attr('font-size', '16px')
          .attr("transform",(d) => { return `translate(${path.centroid(d)})`; });

      path.outerRadius(radius*0.6 + 30);

      selectedArc.select('.num')
        .transition()
        .duration(500)
        .attr('font-size', '24px')
        .attr("transform",(d) => { return `translate(${path.centroid(d)})`; })
        .style('opacity', 0.3);


    });

    arc.on('mouseleave', (ev, i)=> {
      let selectedArc = this.svg.select(`.arc:nth-of-type(${i + 1})`);

      selectedArc.select('path')
        .transition()
        .attr("transform",(d) => { return `translate(0, 0)`; })
        .style('fill', this.colors[i]);

      path.outerRadius(radius*1.4);

      selectedArc.select('.weekday')
        .transition()
        .attr('font-size', '10px')
        .attr("transform",(d) => { return `translate(${path.centroid(d)})`; });

      path.outerRadius(radius*0.6);

      selectedArc.select('.num')
        .transition()
        .duration(500)
        .attr('font-size', '16px')
        .attr("transform",(d) => { return `translate(${path.centroid(d)})`; })
        .style('opacity', 0);


    });

    arc.on('click', (ev, i) => {
       currentDay = i;
       histogram.draw(i, data.hours[i]);
    });

  }
};


