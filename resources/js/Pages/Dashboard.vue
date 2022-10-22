<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Sidebar from '@/Components/Sidebar.vue';
import Helpers from '@/Mixins/Helpers';
</script>

<template>

    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <breadcrumb title="Dashboard" />
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block">
                        <div class="row g-gs">
                            <div class="col-sm-6 col-lg-6 col-xxl-6">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Total Users</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title=""
                                                    data-original-title="Total Users"></em>
                                            </div>
                                        </div>
                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                            <div class="nk-sale-data">
                                                <span class="amount">{{users.total_users}}</span>
                                            </div>
                                            <div class="nk-sales-ck">
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                                <canvas class="sales-bar-chart chartjs-render-monitor"
                                                    id="activeSubscription" width="333" height="84"
                                                    style="display: block; height: 56px; width: 222px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div>
                            <div class="col-sm-6 col-lg-6 col-xxl-6">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Active Users</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title=""
                                                    data-original-title="Active subscription"></em>
                                            </div>
                                        </div>
                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                            <div class="nk-sale-data">
                                                <span class="amount">{{users.total_users_active}}</span>
                                            </div>
                                            <div class="nk-sales-ck">
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                                <canvas class="sales-bar-chart chartjs-render-monitor"
                                                    id="totalSubscription" width="333" height="84"
                                                    style="display: block; height: 56px; width: 222px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div>
                            <div class="col-sm-6 col-lg-6 col-xxl-6">
                                <div class="card card-bordered">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-2">
                                            <div class="card-title">
                                                <h6 class="title">Total Users Balance</h6>
                                            </div>
                                            <div class="card-tools">
                                                <em class="card-hint icon ni ni-help-fill" data-toggle="tooltip"
                                                    data-placement="left" title=""
                                                    data-original-title="Total users balance"></em>
                                            </div>
                                        </div>
                                        <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                            <div class="nk-sale-data">
                                                <span class="amount">{{users.total_users_balance}}</span>
                                            </div>
                                            <div class="nk-sales-ck">
                                                <div class="chartjs-size-monitor">
                                                    <div class="chartjs-size-monitor-expand">
                                                        <div class=""></div>
                                                    </div>
                                                    <div class="chartjs-size-monitor-shrink">
                                                        <div class=""></div>
                                                    </div>
                                                </div>
                                                <canvas class="sales-bar-chart chartjs-render-monitor"
                                                    id="salesRevenue" width="333" height="84"
                                                    style="display: block; height: 56px; width: 222px;"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
import Breadcrumb from '@/Components/Breadcrumb.vue'
export default {
    props: ['users'],
    components: { Breadcrumb },
    mounted(){
        console.log(window.NioApp)
    },
    mixins: [Helpers]
}
</script>

