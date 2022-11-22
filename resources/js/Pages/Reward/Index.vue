<template>
    <Head title="Reward"/>
<Authenticated>
    <breadcrumb title="Rewards" :subTitle="`Total ${rewards.total}`">
        <li><Button type="button" class="btn btn-primary" @click="openModal">Create</Button></li>
    </breadcrumb>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table dataTable no-footer dtr-inline">  
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Total Investment</th>
                        <th scope="col">Amount</th>
                        <th scope="col"  v-if="checkUserPermissions('edit_plans')">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="reward in rewards.data" :key="reward.id">
                        <td data-label="Name">{{reward.name}}</td>
                        <!-- <td data-label="PLan Type">{{plan.plan_type}}</td> -->
                        <td data-label="amount return">{{ formatCurrency(reward.total_investment) }} USDT</td>
                        <td data-label="amount return">{{ formatCurrency(reward.amount) }} USDT</td>
                        <td data-label="Status" v-if="checkUserPermissions('edit_plans')">
                            <VueToggle 
                                :title="reward.status == 1 ? 'Active' : 'Inactive'" 
                                :name="reward.status == 1 ? 'Active' : 'Inactive'"
                                @toggle="changeStatus(reward)" 
                                activeColor="#2a866d" 
                                :toggled="reward.status == 1 ? true : false"
                            />
                        </td>
                        <td data-label="Action">
                            <edit-section 
                                permission="edit_plans"
                                @click="openModal(reward)"
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
import VueToggle from "vue-toggle-component";
export default {
    props: ['rewards' , 'searchKeyword'],
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
        VueToggle
    },
    methods: {
        openModal(reward=null){
            this.emitter.emit('reward-modal', {
                reward: reward
            });
            jQuery.noConflict();
            $('#genericModal').modal('show')
        },
        changeStatus(reward){
            this.$inertia.get(route('reward.status', reward.id), {}, {
                preserveScroll: false,
                onSuccess: () => {
                    NioApp.Toast('Reward Status changed!', 'success');
                }
            });
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