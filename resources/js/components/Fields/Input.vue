<template>
  <div class="col">
    <label :for="name">{{ title }}</label>
    <input :id="name" v-model="formData[name]" :type="type" class="form-control" :placeholder="title">
    <span v-if="formData.errors && formData.errors.has(name)" class="alert-danger">{{ formData.errors.get(name) }}</span>
  </div>
</template>

<script>
import Form from 'vform'

export default {
  props: {
    name: {
      type: String,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    type: {
      type: String,
      required: true
    },
    formData: {
      type: Form,
      required: true
    }
  }
}
</script>
