<template>
    <Head title="Withdrawals"/>
    <Authenticated>
        <breadcrumb :title="`${withdrawal.user.username} Withdrawa Request`"/>
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card card-bordered card-preview">
                    <div class="card-title">
                        <h5 class="text-primary p-2">Withdraw via {{ withdrawal.gateway.name }}</h5>
                    </div>
                    <div class="card-inner">
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Date <span class="font-weight-bold"> {{ formatDateTime(withdrawal.created_at) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                TRX <span class="font-weight-bold"> {{ (withdrawal.trx) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Username <span class="font-weight-bold"> {{ (withdrawal.user.username) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Method <span class="font-weight-bold"> {{ (withdrawal.gateway.name) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Amount <span class="font-weight-bold"> {{ (withdrawal.amount) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Charge <span class="font-weight-bold"> {{ (withdrawal.charge) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                After Charge <span class="font-weight-bold"> {{ (withdrawal.after_charge) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rate <span class="font-weight-bold"> {{ (withdrawal.rate) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Rate <span class="font-weight-bold"> {{ (withdrawal.final_amount) }} </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status <span class="badge badge-pill text-capitalize" :class="getStatusForTable(withdrawal.status)"> {{ withdrawal.status == 0 ? 'pending' : (withdrawal.status == 1 ? 'Active' : 'Rejected') }} </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12">
                <div class="card card-bordered card-preview">
                    <div class="card-title">
                        <h5 class="text-primary p-2">User Withdraw Information</h5>
                    </div>
                    <div class="card-inner">
                        <div class="row mt-4">
                            <div class="col-md-12" v-for="(value, index) in JSON.parse(withdrawal.gateway.input_form)" :key="index">
                                <p>{{ Object.values(value)[0] }}</p>
                                <img v-if="value.type == 'file'" :src="Object.values(JSON.parse(withdrawal.withdraw_information)[index])[0]" />
                                <h6 v-else>{{ Object.values(JSON.parse(withdrawal.withdraw_information)[index])[0] }}</h6>
                            </div>

                            <Button v-if="withdrawal.status == 0 || withdrawal.status == 2" class="btn-success" @click="changeWithdrawStatus(1)">Approve</Button>
                            <Button v-if="withdrawal.status == 0 || withdrawal.status == 1" class="btn-danger" @click="changeWithdrawStatus(2)">Reject</Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Button from '@/Components/Button.vue';
export default {
    props: ['withdrawal'],
    components: {Authenticated, Breadcrumb, Head, Button},
    data(){
        return {

        }
    },
    methods: {
        changeWithdrawStatus(status){
            this.$inertia.visit(route('withdrawals.update', this.withdrawal.id), {
                method: 'put',
                data: {
                    status: status
                },
                onSuccess: () => {
                    NioApp.Toast('Withdraw addedd Successfully', 'success');
                },
                onError: (e) => {
                    NioApp.Toast(Object.values(e)[0], 'error');
                }
            });
        }
    },  
    mounted(){
    },
    mixins: [Helpers]
}
</script>