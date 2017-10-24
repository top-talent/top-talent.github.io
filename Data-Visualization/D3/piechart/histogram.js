let histogram = {
  container: '#histogram',
  isLoading: false,
  svg: '',
  width: 400,
  height: 250,
  proportion: 1.6,
  labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  colors: ['#b0eef3', '#b0cdf3', '#b5b0f3','#d6b0f3', '#f3b0ee','#f3b0cd',
    '#cdf3b0', '#f3b5b0', '#d6b0f3', '#94BDCE', '#95d8f1','#95f1ca',
    '#ec9e4f', '#ebec4f', '#9dec4f', '#4fec4f', '#4fec9e', '#4febec',
    '#fac0f6', '#fac0d9', '#fac4c0', '#fae1c0',  '#f6fac0', '#d9fac0' ],

  drawSelectMessage: function() {
    this.svg.append('text')
      .text('Select a day to see statistics per hour')
      .attr("transform",`translate(${this.width/2}, ${this.height/2})`)
      .attr('text-anchor', 'middle')
      .style('font-size', '20px')
    ;
  },

  draw: function(index, data) {

    this.svg.selectAll('*')
      .remove();

    this.svg.append('rect')
      .attr('x', 0)
      .attr('y', 0)
      .attr('width', this.width)
      .attr('height', this.height-20)
      .attr('rx', 10)
      .attr('ry', 10)
      .style('fill', '#081620')
      .style('stroke', 'white')
      .style('stroke-width', 2);

    this.svg.append('text')
      .attr("transform",`translate(${this.width/2}, 30)`)
      .text(`Popular hours on ${this.labels[index]}`)
      .style('font-size', '8px')
      .style('opacity', 0)
      .transition()
      .duration(200)
      .style('opacity', 1)
      .style('font-size', '24px')
      .style('fill', 'white')
      .transition()
      .duration(100)
      .style('font-size', '20px')
      .style('fill', 'white');

    let g = this.svg.append('g');

    this.addAxes(g, data);

    let gRect = g.selectAll('.h')
      .data(data)
      .enter()
      .append('g')
      .classed('h', true)
      .attr('transform', (d, i) => {
        return `translate(${this.xScale(i) + 22},${this.yScale(d) + 59})`;
      });

    gRect.append('rect')
      .attr('x', 0)
      .attr('y', (d, i) => { return this.height - 100 - this.yScale(d); })
      .attr('width', (this.width - 70) / 24 )
      .attr('height', 0)
      .style('fill', (d, i) => { return this.colors[i]; })
      .style('stroke', (d, i) => { return this.colors[i]; })
      .style('stroke-width', 2)
      .style('opacity', .2)
      .transition()
      .duration(250)
      .delay((d, i) => { return i * 25; })
      .attr('y', -10)
      .attr('height', (d, i) => { return this.height - 100 - this.yScale(d) + 10; })
      .style('opacity', 1)
      .transition()
      .duration(100)
      .attr('y', 0)
      .attr('height', (d, i) => { return this.height - 100 - this.yScale(d); });

    gRect.append('text')
      .text((d,i) => {return i < 10 ? '0' + i : i;})
      .attr('x', (this.width - 60) / 48)
      .attr('y', (d, i) => { return this.height - 120 - this.yScale(d) ; })
      .attr('font-size', '10px')
      .style('stroke', 'white')
      .style('display', 'none')
      .transition()
      .duration(250)
      .delay((d, i) => { return 100 + i * 25; })
      .style('display', 'block');

    gRect.append('text')
      .classed('value', true)
      .text((d,i) => {return d;})
      .attr('x', (this.width - 60) / 48)
      .attr('y', -15)
      .attr('transform', 'scale(1,0)')
      .attr('font-size', '12px')
      .style('stroke', 'white')
      .style('opacity', .4);

    this.svg.selectAll('text')
      .attr('text-anchor', 'middle')
      .style('fill', 'white');

    gRect.on('mouseenter', (ev, i) => {

      let selectedBar = this.svg.select(`.h:nth-of-type(${i + 3})`);

      selectedBar.select('.value')
        .transition()
        .duration(250)
        .attr('transform', 'scale(1,1)');

    });

    gRect.on('mouseleave', (ev, i) => {

      let selectedBar = this.svg.select(`.h:nth-of-type(${i + 3})`);

      selectedBar.select('.value')
        .transition()
        .duration(250)
        .attr('transform', 'scale(1,0)');

    });

  },

  addAxes: function(g, data) {
    this.xScale = d3.scaleLinear()
      .domain([0, 23])
      .range([0, this.width - 50]);
    this.yScale = d3.scaleLinear()
      .domain([0, d3.max(data)])
      .range([this.height - 100, 0]);

    let xAxis = d3.axisBottom()
      .scale(this.xScale)
      .ticks(24);

    let yAxis = d3.axisLeft()
      .scale(this.yScale);

    g.append('g')
      .classed('xAxis', true)
      .attr('fill', 'white')
      .attr('transform', `translate(20, ${this.height - 40})`);

    g.append('g')
      .classed('yAxis', true)
      .attr('fill', 'white')
      .attr('transform', `translate(20, ${60})`);

    g.select('.xAxis')
      .call(xAxis);

    g.select('.yAxis')
      .call(yAxis);

    g.selectAll('.xAxis .domain, .xAxis .tick line, .yAxis .domain, .yAxis .tick line')
      .attr('stroke', 'white');

    g.selectAll('.xAxis .tick *')
      .attr('transform', `translate(${(this.width - 60) / 48},0)`)
  }

};

