<template>
  <div id='barchart'></div>
</template>

<script>
import d3 from 'd3'

export default {

  name: 'BarChart',

  props: {
    data: Array,
    width: Number,
    height: Number
  },

  methods: {
    draw (dataset, isAnimated) {
      d3.select('svg').remove()
      var margin = { top: 20, right: 20, bottom: 30, left: 40 }
      var width = this.width - margin.left - margin.right
      var height = this.height - margin.top - margin.bottom

      var x = d3.scale.ordinal().rangeRoundBands([0, width], 0.1)
      var y = d3.scale.linear().range([height, 0])

      var xAxis = d3.svg.axis().scale(x).orient('bottom')
      var yAxis = d3.svg.axis().scale(y).orient('left').ticks(10, '')

      var svg = d3.select('#barchart')
      .append('svg')
      .attr('width', width + margin.left + margin.right)
      .attr('height', height + margin.top + margin.bottom)
      .append('g')
      .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')')

      // calculate max y axis height
      var yMax = d3.max(dataset, d => d.units)
      yMax = isNaN(yMax) ? 0 : yMax

      x.domain(dataset.map(d => d.brand))
      y.domain([0, yMax])

      svg.append('g')
      .attr('class', 'x axis')
      .attr('transform', 'translate(0,' + height + ')')
      .call(xAxis)

      svg.append('g')
      .attr('class', 'y axis')
      .call(yAxis)
      .append('text')
      .attr('transform', 'rotate(-90)')
      .attr('y', 6)
      .attr('dy', '.71em')
      .style('text-anchor', 'end')
      .text('Units')

      var bars = svg.selectAll('rect')
      .data(dataset)
      .enter()
      .append('rect')
      .attr('class', 'bar')
      .attr('x', d => x(d.brand))
      .attr('y', height)
      .attr('width', x.rangeBand())
      .attr('height', 0)

      // Gradients
      var mainGradient = svg
      .append('linearGradient')
      .attr('y1', 0)
      .attr('y2', yMax * 4)
      .attr('x1', '0')
      .attr('x2', '0')
      .attr('gradientUnits', 'userSpaceOnUse')
      .attr('id', 'gradient')

      mainGradient
      .append('stop')
      .attr('offset', '0')
      .attr('class', 'stop-bottom')

      mainGradient
      .append('stop')
      .attr('offset', '1')
      .attr('class', 'stop-top')

      // Animations
      if (isAnimated) {
        bars.transition()
        .delay((d, i) => i * 150)
        .duration(800)
        .attr('y', d => y(d.units))
        .attr('height', d => height - y(d.units))
      } else {
        bars.attr('y', d => y(d.units)).attr('height', d => height - y(d.units))
      }
    }
  },

  events: {
    // data has been sorted
    dataSorted (key, order) {
      console.log('Brand: ' + this.data[0].brand + ' - ' + this.data[0].units)
      this.data.sort((a, b) => {
        if (a[key] > b[key]) {
          return order * 1
        }
        if (a[key] < b[key]) {
          return order * -1
        }
        return 0
      })
      console.log('Brand: ' + this.data[0].brand + ' - ' + this.data[0].units)
      this.draw(this.data, true)
    }
  },

  ready () {
    this.draw(this.data, true) // initial draw

    // watch data for changes and redraw
    this.$watch('data', (value) => { this.draw(value, false) }, { deep: true })
  }
}
</script>

<style lang='less'>
.bar {
  fill: url(#gradient);
}

.bar:hover {
  fill: lighten(#437cc7, 15%);
}

.axis {
  font: 10px sans-serif;
}

.axis path,
.axis line {
  fill: none;
  stroke: #000;
  shape-rendering: crispEdges;
}

.x.axis path {
  display: none;
}

.stop-bottom {
  stop-color: #b94242;
}

.stop-top {
  stop-color: #437cc7;
}
</style>
