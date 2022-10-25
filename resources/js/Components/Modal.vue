<template>
    <div class="modal fade" id="genericModal" aria-modal="true" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{title}}</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <slot />
                </div>
               
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['title'],
}
</script>

<style>

</style>