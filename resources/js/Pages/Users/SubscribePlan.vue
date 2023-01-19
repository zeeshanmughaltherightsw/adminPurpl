<template>
    <Modal title="Subscribe Plan">
        <form @submit.prevent="submit" class="form-validate is-alter">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="form-group">
                        <Label class="form-label" for="plan_type">Plans</Label>
                        <div class="form-control-wrap">
                            <select v-model="form.plan_id" @change="planSelected()" class="form-control">
                                <option :value="null">--- Select Plan ---</option>
                                <option v-for="(plan, index) in plans" :value="plan.id">{{ plan.name }} - {{ formatCurrency(plan.min_price) }}</option>
                            </select>
                            <Errors :message="form.errors.plan_id" />
                        </div>
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
import { useForm } from '@inertiajs/inertia-vue3';
import Errors from "@/Components/InputError.vue";
import Button from "@/Components/Button.vue";
import Modal from '@/Components/Modal.vue';
import Label from "@/Components/Label.vue";
import Helpers from "@/Mixins/Helpers"
export default {
    props: [],
    components: {Errors, Modal, Label, Button},
    data(){
        return {
            form: null,
            plans: [],
            user: null,
        }
    },
    beforeMount(){
        this.form = useForm({
            plan_id: null,
            amount: 0,
        });

        axios.get(route('manage-plan.index'))
        .then((response)=> {
            this.plans = response.data.filter(obj => obj.plan_type == 'investor');
        });

        this.emitter.on('subscribe-plan-modal', (args) => {
            this.user = args.user
            jQuery.noConflict();
            $('#genericModal').modal('show')
        })
    },
    methods: {
        submit(){
            this.form.post(route('subscribe-plan', this.user.id), {
                onSuccess: () => {
                    NioApp.Toast("Plan Subscribed Successfully", 'success')
                    $('#genericModal').modal('hide')

                },
                onError: () => {
                    NioApp.Toast("Something went wrong", 'error')
                    $('#genericModal').modal('hide')
                }
            });
        },
        planSelected(){
            this.form.amount = this.plans.find(obj => obj.id == this.form.plan_id).min_price;
        }
    },
    mixins: [Helpers]
}
</script>