<template>
  <div class="alert alert-icon" v-if="message" :class="{ 'alert-success': style === 'success', 'alert-danger': style === 'danger' }" role="alert">    
    <em class="icon ni" :class="{ 'ni-check-circle': style === 'success', 'ni-cross-circle': style === 'danger' }"></em>     
  <strong>{{ message }}</strong>.
  </div>
</template>

<script>

export default {
  data() {
    return {
      show: true,
    }
  },

  computed: {
    style() {
      return this.$page.props.flash?.bannerStyle || 'success'
    },

    message() {
      return this.$page.props.flash?.banner || ''
    },

    hideAlert(){
      this.show = false;
      this.$page.props.flash.bannerStyle = '';
      this.$page.props.flash.banner = '';
    }
  },

  watch: {
    style() {
      this.show = true
    },

    message() {
      this.show = true
    }
  }
}
</script>
