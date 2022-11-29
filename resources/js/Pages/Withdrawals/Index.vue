<template>
    <Head title="Withdrawals" />
    <Authenticated>
        <breadcrumb title="Withdrawals">
            <li>
                <select class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white show" v-model="status">
                    <option :value="null" class="dropdown-menu dropdown-menu-end show">All</option>
                    <option value="0" class="dropdown-menu dropdown-menu-end show">Pending</option>
                    <option value="1" class="dropdown-menu dropdown-menu-end show">Approved</option>
                    <option value="2" class="dropdown-menu dropdown-menu-end show">Rejected</option>
                </select>
            </li>
        </breadcrumb>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table
                    class="datatable-init-export nowrap table dataTable no-footer dtr-inline"
                >
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Trx</th>
                            <th scope="col">Username</th>
                            <th scope="col">Status</th>
                            <th scope="col">Method</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Charge</th>
                            <th scope="col">After Charge</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Payable</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="withdrawal in withdrawals.data"
                            :key="withdrawal.id"
                        >
                            <td data-label="Name">
                                {{ formatDateTime(withdrawal.created_at) }}
                            </td>
                            <td data-label="Name">{{ withdrawal.trx }}</td>
                            <td data-label="Name">
                                {{ withdrawal.user.username }}
                            </td>
                            <td data-label="Status">
                                <span class="tb-odr-status"><span class="badge badge-dot text-capitalize" 
                                    :class="{ 'text-success' : withdrawal.status == 1, 'text-danger' : withdrawal.status == 2, 'text-warning' : withdrawal.status == 0 }"
                                    >{{ withdrawal.status == 0 ? 'pending' : (withdrawal.status == 1 ? 'Active' : 'Rejected') }}</span></span>
                            </td>
                            <td data-label="Method name">
                                {{ withdrawal.gateway.name }}
                            </td>
                            <td data-label="Price" class="font-weight-bold">
                                {{ withdrawal.amount }}
                            </td>
                            <td data-label="Price" class="font-weight-bold">
                                {{ withdrawal.charge }}
                            </td>
                            <td data-label="Price" class="font-weight-bold">
                                {{ withdrawal.amount - withdrawal.charge }}
                            </td>
                            <td data-label="Price" class="font-weight-bold">
                                {{ withdrawal.rate }}
                            </td>
                            <td data-label="Price" class="font-weight-bold">
                                {{ withdrawal.final_amount }}
                            </td>
                            
                            <td data-label="Action">
                                <edit-section
                                    permission="edit_withdrawal"
                                    iconType="link"
                                    :url="
                                        route('withdrawals.edit', withdrawal.id)
                                    "
                                />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </Authenticated>
</template>

<script>
import Helpers from "@/Mixins/Helpers";
import Authenticated from "../../Layouts/Authenticated.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
import { Head } from "@inertiajs/inertia-vue3";
import EditSection from "@/Components/EditSection.vue";
import SearchInput from "@/Components/SearchInput.vue";
import Pagination from "@/Components/Pagination.vue";
import Button from "@/Components/Button.vue";
import VueToggle from "vue-toggle-component";
export default {
    props: ["withdrawals", "statuses"],
    data() {
        return {
            searchedKeywords: this.searchKeyword,
            status: this.statuses
        };
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
    },
    methods: {
       
    },
    mounted() {
        window.NioApp.DataTable.init();
    },
    watch: {
        status: {
            handler(newVal, oldVal){
                this.$inertia.visit(route('withdrawals.index'), {
                    method: 'get',
                    data: {
                        status: newVal
                    },});
            }
        }
    },
    mixins: [Helpers],
};
</script>

<style></style>
