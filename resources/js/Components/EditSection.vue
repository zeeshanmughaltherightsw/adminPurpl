<template>
    <div v-if="iconType == 'link'">
        <Link :href="url" @click="removeTooltip()" v-if="checkUserPermissions(permission)"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" 
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" data-bs-original-title="edit">
            <span class="svg-icon svg-icon-3">
                <em class="icon ni ni-edit"></em>
            </span>
        </Link>
    </div>
    <div v-else>
        <div @click="removeTooltip" v-if="checkUserPermissions('edit_product_variants')"
            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="bottom" data-bs-original-title="edit">
            <span class="svg-icon svg-icon-3">
                <em class="icon ni ni-edit"></em>
            </span>
        </div>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3'
    import Helpers from '@/Mixins/Helpers'

    export default {
        props: ['iconType', 'url', 'permission', 'record', ''],

        components: {
            Link,
        },

        methods: {
            removeTooltip() {
                this.hideTooltip()
            }
        },
        mounted(){
            this.showTooltip()
        },
        mixins: [Helpers]
    }
</script>