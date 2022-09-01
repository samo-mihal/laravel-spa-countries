<template>
  <div>
    Detail or create
  </div>
</template>

<script>

export default {
  metaInfo () {
    return {
      title: this.$route.params.country === 'new' ? 'New country' : 'Country detail'
    }
  }
}
</script>
