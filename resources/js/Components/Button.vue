<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    lg: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button :type="type" class="btn btn-primary btn-block text-white pr-4" :class="{ 'btn-lg' : lg }" style="width: 136px; margin-right:18px;">
        <slot />
    </button>
</template>
