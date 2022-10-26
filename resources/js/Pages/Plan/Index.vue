<template>
    <Head title="Plans"/>
<Authenticated>
    <breadcrumb title="Plans" :subTitle="`Total Plans ${plans.total}`">
        <li><Button type="button" class="btn btn-primary" @click="openModal">Create</Button></li>
    </breadcrumb>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table dataTable no-footer dtr-inline">  
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Referrals</th>
                        <th scope="col">Price</th>
                        <th scope="col">Profit %age</th>
                        <th scope="col">Profit Bonus %age</th>
                        <th scope="col">Amount Return</th>
                        <th scope="col">Validity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="plan in plans.data" :key="plan.id">
                        <td data-label="Name">{{plan.name}}</td>
                        <td data-label="Referrals" class="font-weight-bold">{{ plan.min_ref }} to {{ plan.max_ref }} </td>
                        <td data-label="Price" class="font-weight-bold">{{ plan.price }}</td>

                        <td data-label="Profit %age">{{ plan.min_profit_percent }} % to {{ plan.max_profit_percent }} %</td>
                        <td data-label="Profit Bonus %age">{{ plan.profit_bonus_percent }} %</td>
                        <td data-label="amount return">{{ plan.amount_returns }} Days</td>
                        <td data-label="Validity">{{ plan.validity}} Day</td>
                        <td data-label="Status">
                            <span class="badge" :class="getStatusForTable(plan.status)">{{plan.status}}</span>
                        </td>
                        <td data-label="Action">
                            <edit-section 
                                permission="edit_plans"
                                @click="openModal(plan)"
                            />
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>      
    <EditModal />
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Button.vue'
import EditModal from './EditModal'
export default {
    props: ['plans' , 'searchKeyword'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
        }
    },
    components: {
                Authenticated,
                EditSection,
                Head,
                SearchInput,
                Pagination,
                Breadcrumb,
                Button,
                EditModal,
            },
    methods: {
        openModal(plan=null){
            this.emitter.emit('plan-modal', {
                plan: plan
            });
            jQuery.noConflict();
            $('#genericModal').modal('show')
        }
    },
    mounted(){
        window.NioApp.DataTable.init()
    },
    mixins: [Helpers]
}
</script>

<style>

</style>