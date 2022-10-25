<template>
    <Modal :title="form.id ? 'Update plan' : 'Create plan'">
        <form @submit.prevent="submit" class="form-validate is-alter">
            <div class="form-group">
                <Label class="form-label" for="name">Name</Label>
                <div class="form-control-wrap">
                    <Input type="text" placeholder="Plan name" v-model="form.name" :class="{ 'border-danger' : form.errors.name }" class="form-control" id="name" required/>
                    <Errors :message="form.errors.name" />
                </div>
            </div>
            <div class="form-group">
                <Label class="form-label" for="price">Price</Label>
                <div class="form-control-wrap">
                    <Input type="number" placeholder="Plan price"  :class="{ 'border-danger' : form.errors.price }" v-model="form.price" step="0.1" class="form-control" id="price" required/>
                    <Errors :message="form.errors.price" />
                </div>
            </div>
            <div class="form-group">
                <Label class="form-label" for="profit">Profit</Label>
                <div class="form-control-wrap">
                    <Input type="number" placeholder="Plan profit"  :class="{ 'border-danger' : form.errors.estimated_profit }" v-model="form.estimated_profit" step="0.1" class="form-control" id="profit" required/>
                    <Errors :message="form.errors.estimated_profit" />
                </div>
            </div>
            <div class="form-group">
                <Label class="form-label" for="amount_return">Amount return</Label>
                <div class="form-control-wrap">
                    <Input type="number" placeholder="Amount return"  :class="{ 'border-danger' : form.errors.amount_returns }" v-model="form.amount_returns" step="0.1" class="form-control" id="amount_return" required/>
                    <Errors :message="form.errors.amount_returns" />
                </div>
            </div>
            <div class="form-group">
                <Label class="form-label" for="amount_return">Status</Label>
                <div class="form-control-wrap">
                    <VueToggle title="" name="" @toggle="(e) => this.form.status = e" activeColor="#3f54ff" :toggled="form.status"/>
                </div>
            </div>
            <div class="d-flex justify-content-end py-6 px-9">
                <Button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                    ref="submitButton">
                    <span class="indicator-label" v-if="!form.processing">{{ form.id ? "Update" : "Create"}}</span>
                    <span class="indicator-progress" v-if="form.processing">
                        Please wait.
                        <span class="spinner-border spinner-border-sm align-middle ml-2"></span>
                    </span>
                </Button>
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
import VueToggle from "vue-toggle-component";
import { useForm } from '@inertiajs/inertia-vue3';
export default {
    data(){
        return {
            form: null,
        }
    },
    components: {Modal, Button, Input, Label, Errors, VueToggle},
    beforeMount(){
        this.form = useForm({
            name: null,
            price: null,
            amount_returns: null,
            estimated_profit: null,
            status: true
        });
        
    },
    mounted(){
        this.emitter.on('plan-modal', (args)=>{
            console.log(args)
            this.form = useForm({
                id: args.plan.id ? args.plan.id : null,
                name: args.plan.name ? args.plan.name : null,
                price: args.plan.price ? args.plan.price : null,
                amount_returns: args.plan.amount_returns ? args.plan.amount_returns : null,
                estimated_profit: args.plan.estimated_profit ? args.plan.estimated_profit : null,
                status: args.plan.status == 1,
            });
        })
    },
    methods:{
        submit(){
            console.log(this.form)
            if(this.form.id){
                this.form.put(route('manage-plan.update', this.form.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        $('#genericModal').modal('hide');
                    }
                });
            }else{
                this.form.post(route('manage-plan.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        $('#genericModal').modal('hide');
                    }
                });
            }
        }
    }
}
</script>

<style>

</style>