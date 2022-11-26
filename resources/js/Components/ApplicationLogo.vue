<template>
    <img class="logo-light logo-img" :src="getImage('logo.png')" :srcset="getImage('logo.png')" alt="logo"/>
    <img class="logo-dark logo-img" :src="getImage('logo.png')" :srcset="getImage('logo.png')" alt="logo-dark"/>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
export default {
    props: ['width'],
    mixins: [Helpers]
}
</script>