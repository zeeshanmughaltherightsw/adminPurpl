<template>


<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">{{ title }}</h3>
            <div class="nk-block-des text-soft" v-if="subTitle"> 
                <p>{{ subTitle }}</p>
            </div>
        </div>
        <div class="nk-block-head-content">
            <div class="toggle-wrap nk-block-tools-toggle">
                <a href="#" class="btn btn-icon btn-trigger toggle-expand mr-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                <div class="toggle-expand-content" data-content="pageMenu">
                    <ul class="nk-block-tools g-3">
                        <slot name="breadcrumbplugin"/>
                    </ul>
                </div>
            </div>
        </div>        
    </div>
</div>
</template>

<script>
export default {
    props: ['title', 'subTitle'],
}
</script>

<style>

</style>