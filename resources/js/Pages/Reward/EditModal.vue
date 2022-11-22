<template>
    <Modal :title="form.id ? 'Update reward plan' : 'Create reward plan'">
        <form @submit.prevent="submit" class="form-validate is-alter">
            <div class="row">
                <div class="col-md-12 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="name">Name</Label>
                        <div class="form-control-wrap">
                            <Input type="text" placeholder="Plan name" v-model="form.name"
                                :class="{ 'border-danger': form.errors.name }" class="form-control" id="name"
                                required />
                            <Errors :message="form.errors.name" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="price">Total Investment</Label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <Input type="number" 
                                    placeholder="Price"
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.total_investment }" 
                                    v-model="form.total_investment"
                                    step="0.1" 
                                    id="price"
                                    required />
                                <div class="input-group-append">            
                                    <span class="input-group-text">USD</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.total_investment" />
                    </div>
                </div>
                <div class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="price">Reward Amount</Label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <Input type="number" 
                                    placeholder="Price"
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.amount }" 
                                    v-model="form.amount"
                                    step="0.1" 
                                    id="price"
                                    required />
                                <div class="input-group-append">            
                                    <span class="input-group-text">USD</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.amount" />
                    </div>
                </div>
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="d-flex justify-content-end py-6 px-9">
                        <Button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            ref="submitButton">
                            <span class="indicator-label" v-if="!form.processing">{{ form.id ? "Update" :
                                    "Create"
                            }}</span>
                            <span class="indicator-progress" v-if="form.processing">
                                Please wait.
                                <span class="spinner-border spinner-border-sm align-middle ml-2"></span>
                            </span>
                        </Button>
                    </div>
                </div>
            </div>
        </form>
    </Modal>
</template>

<script>
import Modal from '@/Components/Modal.vue';
import Button from '@/Components/Button.vue'
import Label from '@/Components/Label.vue'
import Input from '@/Components/Input.vue';
import Errors from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/inertia-vue3';
export default {
    data() {
        return {
            form: null,
            hideName: null,
            showName: null,
        }
    },
    components: { Modal, Button, Input, Label, Errors },
    beforeMount() {
        this.form = useForm({
            name: null,
            total_investment: 0,
            amount: 0,
            status: null,
        });

    },
    mounted() {
        this.emitter.on('reward-modal', (args) => {
            this.form = useForm({
                id: args.reward.id ? args.reward.id : null,
                name: args.reward.name ? args.reward.name : null,
                total_investment:  args.reward.total_investment ? args.reward.total_investment : 0,
                amount:  args.reward.amount ? args.reward.amount : 0,
            });
        })
    },
    methods: {
        submit() {
            if (this.form.id) {
                this.form.put(route('reward.update', this.form.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        $('#genericModal').modal('hide');
                    }
                });
            } else {
                this.form.post(route('reward.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        $('#genericModal').modal('hide');
                    }
                });
            }
        }
    },
}
</script>

<style>

</style>