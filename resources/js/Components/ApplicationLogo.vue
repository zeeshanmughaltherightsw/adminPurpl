<template>
    <img class="logo-light logo-img" src="/logo.png" srcset="/logo.png" alt="logo"/>
    <img class="logo-dark logo-img" src="/logo.png" srcset="/logo.png" alt="logo-dark"/>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
export default {
    props: ['width'],
    mixins: [Helpers]
}
</script>