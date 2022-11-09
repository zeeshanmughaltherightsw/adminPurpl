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
                        <th scope="col">Price</th>
                        <th scope="col">Plan Type</th>
                        <th scope="col">Expires</th>
                        <th scope="col"  v-if="checkUserPermissions('edit_plans')">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="plan in plans.data" :key="plan.id">
                        <td data-label="Name">{{plan.name}}</td>
                        <!-- <td data-label="PLan Type">{{plan.plan_type}}</td> -->
                        <td data-label="Price" class="font-weight-bold">{{ plan.min_price }} to {{ plan.max_price }}</td>
                        <td data-label="Referrals" class="font-weight-bold">{{ plan.plan_type }} </td>
                        <td data-label="amount return">{{ plan.expire * 100}} %</td>
                        <td data-label="Status" v-if="checkUserPermissions('edit_plans')">
                            <VueToggle :title="plan.status" :name="plan.status " @toggle="changeStatus(plan)" activeColor="#2a866d" :toggled="plan.status ? true : false"/>
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
import VueToggle from "vue-toggle-component";
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
        VueToggle
    },
    methods: {
        openModal(plan=null){
            this.emitter.emit('plan-modal', {
                plan: plan
            });
            jQuery.noConflict();
            $('#genericModal').modal('show')
        },
        changeStatus(plan){
            this.$inertia.get(route('manage-plan.status', plan.id), {}, {
                preserveScroll: false,
                onSuccess: () => {
                    NioApp.Toast('Plan Status changed!', 'success');
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