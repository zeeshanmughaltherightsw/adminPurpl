<template>
    <Head title="Gateways"/>
<Authenticated>
    <breadcrumb title="Gateways">
        <li><Link class="btn btn-primary" :href="route('gateway.create', type)">Create</Link></li>
    </breadcrumb>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table dataTable no-footer dtr-inline">  
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Gateway</th>
                        <th scope="col">Created at</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(gateway, index) in gateways.data" :key="gateway.id">
                        <td data-label="No">{{ index+1 }}</td>
                        <td data-label="Name">
                            <div class="user d-flex">
                                <div class="thumb">
                                    <img :src="getImage(gateway.media?.file_name, false, 'thumb', gateway.is_external)" width="40" :alt="gateway.media?.name" style="margin: auto 10px;">
                                </div>
                                    <span class="name">{{gateway.name}}</span>
                            </div>
                        </td>
                        <td data-label="Price" class="font-weight-bold">{{ formatDate(gateway.created_at) }}</td>
                        
                        <td data-label="Action">
                            <div class="d-flex" style="width: 50px; margin-right: -100px;">
                                <vue-toggle
                                    title="" 
                                    name="" 
                                    :toggled="booleanStatusValue(gateway.status)"
                                    @toggle="toggle($event, gateway.id)"
                                />
                                <edit-section
                                    :permission="['edit_gateway',]"
                                    iconType="link"
                                    :url="route('gateway.edit', [type, gateway.id])"/>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>      
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Button from '@/Components/Button.vue'
import VueToggle from "vue-toggle-component";
export default {
    props: ['gateways' , 'searchKeyword', 'type'],
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
        VueToggle,
        Link
    },
    methods: {
        openModal(plan=null){
          
        },
        changeStatus(plan){
            // this.$inertia.get(route('manage-plan.status', plan.id), {}, {
            //     preserveScroll: false,
            //     onSuccess: () => {
            //         NioApp.Toast('Plan Status changed!', 'success');
            //     }
            // });
        }
    },
    mounted(){
        NioApp.DataTable.init()
    },
    mixins: [Helpers]
}
</script>

<style>

</style>