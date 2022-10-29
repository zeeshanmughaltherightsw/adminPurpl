<template>
    <Modal :title="form.id ? 'Update plan' : 'Create plan'">
        <form @submit.prevent="submit" class="form-validate is-alter">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-group">
                        <Label class="form-label" for="plan_type">Plan Type</Label>
                        <div class="form-control-wrap">
                            <select v-model="form.plan_type"  @change="cascade" class="form-control">
                                <option :value="null">--- Select Plan ---</option>
                                <option value="investor">For Investor</option>
                                <option value="referral">For Referral</option>
                                <option value="agent">For Highly Agent</option>
                            </select>
                            <Errors :message="form.errors.plan_type" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-2" v-if="form.plan_type">
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
                <div v-if="hideName && form.plan_type" class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="price">Price</Label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <Input type="number" 
                                    placeholder="Price"
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.price }" 
                                    v-model="form.price"
                                    step="0.1" 
                                    id="price"
                                    required />
                                <div class="input-group-append">            
                                    <span class="input-group-text">USD</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.price" />
                    </div>
                </div>
                <div v-if="hideName && form.plan_type" class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="min_profit">Min Profit</Label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <Input type="number" 
                                    placeholder="Min profit"
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.min_profit }" 
                                    v-model="form.min_profit"
                                    step="0.1" 
                                    id="min_profit"
                                    required />
                                <div class="input-group-append">            
                                    <span class="input-group-text">%</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.min_profit" />
                    </div>
                </div>
                <div v-if="hideName && form.plan_type" class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="max_profit">Max Profit</Label>
                        <div class="form-control-wrap">
                            <div class="input-group">
                                <Input type="number" 
                                    placeholder="Max profit"
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.max_profit }" 
                                    v-model="form.max_profit"
                                    step="0.1" 
                                    id="max_profit"
                                    required />
                                <div class="input-group-append">            
                                    <span class="input-group-text">%</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.max_profit" />
                    </div>
                </div>
                <div v-if="showName && form.plan_type" class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="min_ref">Min Referrals</Label>
                        <div class="form-control-wrap">
                            <Input  type="number" placeholder="Min referral" v-model="form.min_ref"
                                :class="{ 'border-danger': form.errors.min_ref }" class="form-control" id="min_ref"
                                required />
                            <Errors :message="form.errors.min_ref" />
                        </div>
                    </div>
                </div>

                <div v-if="showName && form.plan_type" class="col-md-6 my-2">
                    <div class="form-group">
                        <Label class="form-label" for="max_ref">Max Referrals</Label>
                        <div class="form-control-wrap">
                            <Input :disabled="inputDisabled" type="number" placeholder="Max referral" v-model="form.max_ref"
                                :class="{ 'border-danger': form.errors.max_ref }" class="form-control" id="max_ref"
                                required />
                            <Errors :message="form.errors.max_ref" />
                        </div>
                    </div>
                </div>
                <div v-if="showName && form.plan_type" class="col-md-6  my-2">
                    <div class="form-group">
                        <Label class="form-label" for="ref_commission">Referral Commission</Label>
                        <div class="form-control-wrap">
                            <Input :disabled="inputDisabled" type="number" placeholder="Referral Commission" v-model="form.ref_commission"
                                :class="{ 'border-danger': form.errors.ref_commission }" class="form-control" id="ref_commission"
                                required />
                            <Errors :message="form.errors.ref_commission" />
                        </div>
                    </div>
                </div>
                <div v-if="form.plan_type" class="col-md-6  my-2">
                    <div class="form-group">
                        <Label class="form-label" for="amount_return">Amount return</Label>
                        <div class="form-control-wrap">    
                            <div class="input-group">     
                                <input 
                                    type="number" placeholder="Amount return" 
                                    class="form-control"
                                    :class="{ 'border-danger': form.errors.amount_returns }" 
                                    v-model="form.amount_returns"
                                    minlength="0"
                                    id="amount_return" required 
                                    >        
                                <div class="input-group-append">            
                                    <span class="input-group-text">Days</span>        
                                </div>    
                            </div>
                        </div>
                        <Errors :message="form.errors.amount_returns" />
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
            price: null,
            amount_returns: null,
            min_profit: null,
            max_profit: null,
            plan_type: null,
            min_ref: null,
            max_ref: null,
            ref_commission: null,
            status: null,
        });

    },
    mounted() {
        this.emitter.on('plan-modal', (args) => {
            this.form = useForm({
                id: args.plan.id ? args.plan.id : null,
                name: args.plan.name ? args.plan.name : null,
                min_ref: args.plan.min_ref ? args.plan.min_ref : null,
                max_ref: args.plan.max_ref ? args.plan.max_ref : null,
                ref_commission: args.plan.ref_commission ? args.plan.ref_commission : null,
                price: args.plan.price ? args.plan.price : null,
                amount_returns: args.plan.amount_returns ? args.plan.amount_returns : null,
                min_profit: args.plan.min_profit ? args.plan.min_profit : null,
                max_profit: args.plan.max_profit ? args.plan.max_profit : null,
                plan_type: args.plan.plan_type ? args.plan.plan_type : null,
            });
        })
    },
    methods: {
        cascade: function(e){
            if (e.target.value == 'investor'){
                this.hideName = true;
                this.showName = false;
            }else{
                this.hideName = false;
                this.showName = true;
            }
        },

        submit() {
            if (this.form.id) {
                this.form.put(route('manage-plan.update', this.form.id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset();
                        $('#genericModal').modal('hide');
                    }
                });
            } else {
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