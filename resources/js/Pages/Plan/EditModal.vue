<template>
    <Modal title="Create plan">
        <form action="#" class="form-validate is-alter">
            <div class="form-group">
                <label class="form-label" for="full-name">Name</label>
                <div class="form-control-wrap">
                    <Input type="text" class="form-control" id="full-name" required/>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from '@/Components/Modal.vue';
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue';
export default {
    components: {Modal, Button, Input}
}
</script>

<style>

</style>