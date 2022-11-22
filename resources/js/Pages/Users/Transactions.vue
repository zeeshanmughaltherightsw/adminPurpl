<template>
  <Head title="Transactions" />
<Authenticated>
    <breadcrumb title="Transactions"/>
   
    <div class="card card-bordered card-stretch">
        <div class="card-inner-group">
            <div class="card-inner p-0">
                <table class="table table-orders" v-if="transactions.data.length > 0">
                    <thead class="tb-odr-head">
                        <tr class="tb-odr-item">
                            <th class="tb-odr-info">
                                <span class="tb-odr-id">Transaction ID</span>
                                <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                            </th>
                            <th class="tb-odr-amount">
                                <span class="tb-odr-total">Amount</span>
                            </th>
                            <th>
                                <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tb-odr-body">
                        <tr class="tb-odr-item" v-for="transaction in transactions.data" :key="transaction.id">
                            <td class="tb-odr-info">
                                <span class="tb-odr-id"><a href="html/invoice-details.html">{{transaction.trx}}</a></span>
                                <span class="tb-odr-date">{{formatDateTime(transaction.created_at)}}</span>
                            </td>
                            <td class="tb-odr-amount">
                                <span class="tb-odr-total">
                                    <span class="amount">{{transaction.amount}}</span>
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-dot" :class="{ 'badge-info' : transaction.trx_type == '-', 'badge-success' : transaction.trx_type !== '-' }">
                                    {{ transaction.trx_type == '-' ? 'Debitted' : 'Credited' }}
                                </span>
                            </td>
                        </tr><!-- .tb-odr-item -->
                    </tbody>
                </table>
                <p v-else class="py-3 px-5">
                    No Record found
                </p>
            </div><!-- .card-inner -->
        </div><!-- .card-inner-group -->
    </div>
    <pagination :meta="transactions" callType="transactions" />
</Authenticated>
</template>

<script>
import Pagination from '@/Components/Pagination.vue'
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Authenticated from '../../Layouts/Authenticated.vue';
import Helpers from '@/Mixins/Helpers';
import { Head } from "@inertiajs/inertia-vue3";
export default {
    props: ['transactions'],
    components: {
        Pagination,
        Breadcrumb,
        Authenticated,
        Head
    },
    mixins: [Helpers]
}
</script>

<style>

</style>