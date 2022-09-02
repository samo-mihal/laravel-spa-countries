<template>
  <select v-model="continent" class="form-select" @change="onOptionChange">
    <option value="" selected>
      {{ firstItemTitle }}
    </option>
    <option v-for="continentItem in continents" :key="continentItem.code" :value="continentItem.code">
      {{ continentItem.name }}
    </option>
  </select>
</template>

<script>
import axios from 'axios'

export default {
  props: {
    firstItemTitle: {
      type: String,
      default: 'Continent'
    },
    prefilledContinent: {
      type: String,
      default: ''
    }
  },

  data: () => ({
    continents: [],
    continent: ''
  }),

  watch: {
    prefilledContinent: function (val) {
      this.continent = val
    }
  },

  mounted () {
    axios.get('/api/continents').then(res => {
      this.continents = res.data
    })
  },

  methods: {
    onOptionChange () {
      this.$emit('continent-change', this.continent)
    }
  }
}
</script>
