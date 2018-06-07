<template>
  <section id="app">

    <div class="left">
      <form id="search" v-on:submit.prevent>
        <input name="query" placeholder="Search..." v-model="searchQuery">
      </form>

      <grid
        :data="gridData"
        :columns="gridColumns"
        :filter-key="searchQuery"
        v-on:sorted="onSorted">
      </grid>
    </div>

    <div class="right">

      <bar-chart
        :data="gridData"
        :width="600"
        :height="500">
      </bar-chart>
    </div>

  </section>
</template>

<script>
  import Grid from './components/Grid.vue'
  import BarChart from './components/BarChart.vue'

  export default {
    name: 'App',

    components: {
      Grid,
      BarChart
    },

    data () {
      return {
        searchQuery: '',
        gridColumns: ['brand', 'units'],
        gridData: [
          { brand: 'BMW', units: 33, selected: false },
          { brand: 'Mercedes', units: 33, selected: false },
          { brand: 'Renault', units: 69, selected: false },
          { brand: 'Audi', units: 36, selected: false },
          { brand: 'Volvo', units: 33, selected: false },
          { brand: 'Citroen', units: 47, selected: false },
          { brand: 'Nissan', units: 21, selected: false },
          { brand: 'Porsche', units: 13, selected: false },
          { brand: 'Ferrari', units: 4, selected: false }
        ]
      }
    },

    methods: {
      onSorted (key, order) {
        this.$broadcast('dataSorted', key, order)
      }
    }
  }
</script>

<style lang="less">
  body {
    font-family: Helvetica Neue, Arial, sans-serif;
  }

  h1 {
    margin: 25px auto;
    text-align: center;
    font-family: Helvetica, Arial, sans-serif;
    color: #B1B1B1;
  }

  #app {
    margin: auto;
    font-size: 14px;
    color: #444;
    padding: 12px;
    min-width: 1010px;
    width: 80%;
    height: 860px;

    .left {
      width: 50%;
      height: 860px;
      float: left;
    }

    .right {
      margin-top: 50px;
      margin-left: 50%;
      height: 860px;
      padding-left: 10px;
    }

    #search {
      margin-bottom: 10px;
      margin-right: 12px;

      input {
        width: 100%;
        height: 16px;
        padding: 4px;
        color: #363434;
        border: 2px solid #b5b5b5;
        border-radius: 3px;
      }
    }

    .fadeIn-transition {
      transition: opacity 400ms ease;
    }

    .fadeIn-enter {
      opacity: 0;
    }

    .fadeIn-leave {
      transition-duration: 0s;
      opacity: 0;
    }

  }
</style>
