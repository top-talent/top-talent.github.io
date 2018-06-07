<template>
  <div id="grid">

    <table>
      <thead>
        <tr>
          <th v-for="key in columns"
          @click="sortBy(key)"
          :class="{active: sortKey == key}">
          {{key | capitalize}}
          <span class="arrow"
          :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
        </span>
      </th>
      <th class="fa fa-trash deleteCol" title="Select all" @click="selectAll"></th>
    </tr>
  </thead>
  <tbody>
    <tr :class="{'selected': entry.selected}" v-for="entry in data | filterBy filterKey | orderBy sortKey sortOrders[sortKey]">
    <td v-for="key in columns">
      <input type="input" v-model="entry[key] | validate key">
    </td>
    <td class="deleteCol">
      <input type="checkbox" name="row-{{ $index }}" v-model="entry.selected">
    </td>
  </tr>
</tbody>
</table>

<div class="addNew" v-show="!hasSelected" transition="fadeIn">
  <input class="addInput" type="input" name="inputBrand" placeholder="Brand" v-model="newItem.brand">
  <input class="addInput" type="input" name="inputUnits" placeholder="Units" v-model="newItem.units">
  <button class="insert" type="button" name="addNew" @click="addRow">
    <i class="fa fa-plus fa-lg"></i>Add Row
  </button>
</div>
<div class="deleteRows" v-show="hasSelected" transition="fadeIn">
  <button class="delete" type="button" name="deleteRows" @click="deleteRows">Delete Rows</button>
</div>

</div>
</template>

<script>
export default {

  name: 'Grid',

  props: {
    data: Array,
    columns: Array,
    filterKey: String
  },

  data () {
    var sortOrders = {}
    this.columns.forEach(key => { sortOrders[key] = 1 })

    return {
      sortKey: '',
      sortOrders: sortOrders,
      newItem: {}
    }
  },

  computed: {
    hasSelected () {
      return this.data.filter(item => item.selected).length
    }
  },

  methods: {
    sortBy (key) {
      this.sortKey = key
      this.sortOrders[key] = this.sortOrders[key] * -1
      this.$dispatch('sorted', key, this.sortOrders[key])
    },

    addRow () {
      // Validate
      if (this.newItem.units) {
        this.newItem.units = isNaN(this.newItem.units) ? 0 : parseInt(this.newItem.units, 10)
      } else {
        this.newItem.units = 0
      }

      this.data.push({ brand: this.newItem.brand, units: parseInt(this.newItem.units, 10) })
      this.newItem = {}
    },

    selectAll () {
      var selectCount = this.data.filter(item => item.selected).length

      if (selectCount === this.data.length) {
        this.data.forEach(entry => { entry.selected = false })
      } else {
        this.data.forEach(entry => { entry.selected = true })
      }
    },

    deleteRows () {
      this.data.filter(row => row.selected)
      .forEach(selected => {
        var index = this.data.indexOf(selected)
        this.data.splice(index, 1)
      })
    }
  },

  filters: {
    // validate the input (Number or String)
    validate: {
      read (value) {
        return value
      },
      write (value, oldValue, key) {
        // validate only the number input
        if (key === 'units') {
          if (!value.length) {
            return 0
          } else {
            return isNaN(value) ? 0 : parseInt(value, 10)
          }
        } else {
          return value
        }
      }
    }
  }

}
</script>

<style lang="less">
@mainColor: #437cc7;
@submitColor: #42b983;
@deleteColor: #b94242;

#grid {

  i.fa {
    margin-right: 10px;
  }

  button {
    color: #fff;
    float: left;
    margin-top: 10px;
    padding: 8px 10px;
    font-weight: bold;
    box-sizing: border-box;
    border-radius: 3px;
    cursor: pointer;

    &.insert {
      width: 26%;
      background-color: @submitColor;
      border: 2px solid darken(@submitColor, 10%);
    }

    &.delete {
      width: 100%;
      background-color: @deleteColor;
      border: 2px solid darken(@deleteColor, 10%);
    }

    &.insert:hover {
      background-color: darken(@submitColor, 10%);
    }

    &.delete:hover {
      background-color: darken(@deleteColor, 10%);
    }
  }

  .addInput {
    padding: 8px;
    float: left;
    margin-right: 1%;
    margin-top: 10px;
    border-radius: 3px;
    width: 36%;
    box-sizing: border-box;
    background-color: lighten(@submitColor, 50%);;
    border: 2px solid darken(@submitColor, 10%);;

    &::-webkit-input-placeholder {
      color: @submitColor;
    }

    &:-moz-placeholder {
      color: @submitColor;
    }

    &::-moz-placeholder {
      color: @submitColor;
    }

    &:-ms-input-placeholder {
      color: @submitColor;
    }
  }

  table {
    // border-collapse: collapse;
    border: 2px solid @mainColor;
    border-radius: 3px;
    background-color: #fff;
    width: 100%;
  }

  th {
    background-color: @mainColor;
    color: rgba(255,255,255,0.66);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -user-select: none;
  }

  td {
    background-color: #f9f9f9;

    input {
      width: 100%;
      padding: 3px;
    }
  }

  th, td {
    min-width: 120px;
    padding: 10px 26px 10px 16px;
  }

  th.active {
    color: #fff;
  }

  th.active .arrow {
    opacity: 1;
  }

  tr.selected td {
    background-color: lighten(@deleteColor, 20%);
    transition: background-color 300ms linear;
  }

  .deleteCol {
    color: #fff;
    display: table-cell;
    min-width: 0;
    max-width: 44px;
    padding: 10px 8px;
  }

  .arrow {
    display: inline-block;
    vertical-align: middle;
    width: 0;
    height: 0;
    margin-left: 5px;
    opacity: 0.66;
  }

  .arrow.asc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-bottom: 4px solid #fff;
  }

  .arrow.dsc {
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid #fff;
  }
}
</style>
