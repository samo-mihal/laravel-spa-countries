<template>
  <div>
    <h1>{{ name }}</h1>
    <form @submit.prevent="updateOrCreate" @keydown="country.onKeydown($event)">
      <div class="row">
        <VueInput type="text" title="Name" name="name" :form-data="country" />
        <VueInput type="text" title="Full name" name="full_name" :form-data="country" />
      </div>
      <div class="row">
        <VueInput type="text" title="ISO3" name="iso3" :form-data="country" />
        <VueInput type="number" title="Number" name="number" :form-data="country" />
      </div>
      <div class="row">
        <VueInput type="text" title="Code" name="code" :form-data="country" />
        <VueInput type="number" title="Display order" name="display_order" :form-data="country" />
      </div>
      <div class="row mt-2">
        <div class="col">
          <ContinentsSelect :prefilled-continent="country.continent_code"
                            @continent-change="(newContinent) => {country.continent_code = newContinent}"
          />
        </div>
      </div>
      <input type="submit" class="btn btn-primary mt-2" :value="isNew ? 'Submit' : 'Update'">
    </form>
  </div>
</template>

<script>
import VueInput from '../../components/Fields/Input'
import axios from 'axios'
import Form from 'vform'
import ContinentsSelect from '../../components/Fields/ContinentsSelect'

export default {
  components: {
    VueInput,
    ContinentsSelect
  },

  metaInfo () {
    return {
      title: this.name
    }
  },

  data: () => ({
    name: '',
    isNew: true,
    country: new Form({
      name: '',
      full_name: '',
      code: '',
      continent_code: '',
      display_order: 0,
      number: 0,
      iso3: ''
    })
  }),

  created () {
    this.isNew = this.$route.params.country === 'new'
    this.name = this.isNew ? 'New country' : 'Country detail'
  },

  mounted () {
    if (!this.isNew) {
      axios.get('/api/countries/' + this.$route.params.country).then(res => {
        this.country = new Form(res.data)
      })
    }
  },

  methods: {
    updateOrCreate () {
      this.country.post('/api/countries/' + (this.isNew ? '' : this.$route.params.country)).then(r => {
        this.$router.push({ name: 'countries.list' })
      })
    }
  }
}
</script>
