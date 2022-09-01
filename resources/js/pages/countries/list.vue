<template>
  <div>
    <h1>List of countries</h1>
    <router-link class="btn btn-primary" :to="{name: 'countries.detail', params: { country: 'new' }}">
      New
    </router-link>
    <table class="table">
      <thead>
        <tr>
          <th v-for="field in fields"
              :key="field.name"
              class="cursor-pointer"
              scope="col"
              @click="changeOrder(field.name)"
          >
            {{ field.label }}
            <template v-if="field.name === orderBy">
              {{ order === 'ASC' ? '↑' : '↓' }}
            </template>
          </th>
          <th scope="col" />
        </tr>
      </thead>
      <tbody>
        <tr v-for="country in countries.data" :key="country.country_id">
          <td v-for="field in fields" :key="field.name">
            {{ country[field.name] }}
          </td>
          <router-link class="btn btn-warning" :to="{name: 'countries.detail', params: { country: country.country_id }}">
            Edit
          </router-link>
        </tr>
      </tbody>
    </table>
    <pagination :data="countries" :limit="5" :align="'center'" @pagination-change-page="getCountries" />
  </div>
</template>

<script>
import axios from 'axios'
import pagination from 'laravel-vue-pagination'

export default {
  components: {
    pagination
  },
  layout: 'basic',

  metaInfo () {
    return { title: 'List of countries' }
  },

  data: () => ({
    countries: [],
    order: 'ASC',
    orderBy: 'display_order',
    fields: [
      {
        name: 'country_id',
        label: 'Id'
      },
      {
        name: 'code',
        label: 'Code'
      },
      {
        name: 'name',
        label: 'Name'
      },
      {
        name: 'full_name',
        label: 'Full name'
      },
      {
        name: 'iso3',
        label: 'ISO3'
      },
      {
        name: 'number',
        label: 'Number'
      },
      {
        name: 'continent_code',
        label: 'Continent code'
      },
      {
        name: 'display_order',
        label: 'Display order'
      }
    ]
  }),

  mounted () {
    this.getCountries()
  },

  methods: {
    getCountries (page = 1) {
      const searchParams = new URLSearchParams()
      searchParams.set('page', String(page))
      searchParams.set('orderBy', this.orderBy)
      searchParams.set('order', this.order)

      axios.get('/api/countries?' + searchParams.toString()).then(res => {
        this.countries = res.data
      })
    },
    changeOrder (orderBy) {
      this.order = this.order === 'ASC' ? 'DESC' : 'ASC'
      this.orderBy = orderBy
      this.getCountries()
    }
  }
}
</script>

<style>
  .cursor-pointer {
    cursor: pointer;
  }
</style>
