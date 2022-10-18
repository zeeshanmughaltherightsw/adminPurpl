<template>
    <img class="logo-dark logo-img"  :src="getImage('logo.png')" alt="logo" />
</template>
<script>
import Helpers from '@/Mixins/Helpers';
export default {
    props: ['width'],
    mixins: [Helpers]
}
</script>