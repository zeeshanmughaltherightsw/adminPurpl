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
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Total Users Investment</h6>
                                            </div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    aria-label="Total Deposited"
                                                    data-bs-original-title="Total Deposited"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount"> {{ users.total_users_balance }}
                                                <span class="currency currency-usd">USD</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Total Users</h6>
                                            </div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    aria-label="Total Deposited"
                                                    data-bs-original-title="Total Deposited"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount"> {{ users.total_users }}
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group align-start mb-0">
                                            <div class="card-title">
                                                <h6 class="subtitle">Total Active Users</h6>
                                            </div>
                                            <div class="card-tools"><em class="card-hint icon ni ni-help-fill"
                                                    data-bs-toggle="tooltip" data-bs-placement="left"
                                                    aria-label="Total Deposited"
                                                    data-bs-original-title="Total Deposited"></em></div>
                                        </div>
                                        <div class="card-amount"><span class="amount"> {{ users.total_users_active }}
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner">
                                        <div class="card-title-group mb-1">
                                            <div class="card-title">
                                                <h6 class="title">Investment Overview</h6>
                                                <p>The investment overview of your platform. <a href="#">All
                                                        Investment</a></p>
                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs" role="tablist">
                                            <li class="nav-item" role="presentation"><a class="nav-link active"
                                                    data-bs-toggle="tab" href="#overview" aria-selected="true"
                                                    role="tab">Overview</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-bs-toggle="tab" href="#thisyear" aria-selected="false"
                                                    tabindex="-1" role="tab">This Year</a></li>
                                            <li class="nav-item" role="presentation"><a class="nav-link"
                                                    data-bs-toggle="tab" href="#alltime" aria-selected="false"
                                                    tabindex="-1" role="tab">All Time</a></li>
                                        </ul>
                                        <div class="tab-content mt-0">
                                            <div class="tab-pane active" id="overview" role="tabpanel">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Actived Investment</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">49,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">56</span><span
                                                                    class="change up text-danger"><em
                                                                        class="icon ni ni-arrow-long-up"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">49,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Paid Profit</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Investment in this Month</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">49,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">23</span><span
                                                                    class="change down text-danger"><em
                                                                        class="icon ni ni-arrow-long-down"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="thisyear" role="tabpanel">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Actived Investment</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">89,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">96</span><span
                                                                    class="change up text-danger"><em
                                                                        class="icon ni ni-arrow-long-up"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">99,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Paid Profit</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Investment in this Month</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">149,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">83</span><span
                                                                    class="change down text-danger"><em
                                                                        class="icon ni ni-arrow-long-down"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="alltime" role="tabpanel">
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Currently Actived Investment</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">249,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">556</span><span
                                                                    class="change up text-danger"><em
                                                                        class="icon ni ni-arrow-long-up"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">149,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Paid Profit</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="invest-ov gy-2">
                                                    <div class="subtitle">Investment in this Month</div>
                                                    <div class="invest-ov-details">
                                                        <div class="invest-ov-info">
                                                            <div class="amount">249,395.395 <span
                                                                    class="currency currency-usd">USD</span></div>
                                                            <div class="title">Amount</div>
                                                        </div>
                                                        <div class="invest-ov-stats ms-1">
                                                            <div><span class="amount">223</span><span
                                                                    class="change down text-danger"><em
                                                                        class="icon ni ni-arrow-long-down"></em>1.93%</span>
                                                            </div>
                                                            <div class="title">Plans</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xxl-4">
                                <div class="card card-bordered card-full">
                                    <div class="card-inner d-flex flex-column h-100">
                                        <div class="card-title-group mb-3">
                                            <div class="card-title">
                                                <h6 class="title">Top Invested Plan</h6>
                                                <p>In last 30 days top invested schemes.</p>
                                            </div>
                                            <div class="card-tools mt-n4 me-n1">
                                                <div class="drodown"><a href="#"
                                                        class="dropdown-toggle btn btn-icon btn-trigger"
                                                        data-bs-toggle="dropdown"><em
                                                            class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><span>15 Days</span></a></li>
                                                            <li><a href="#" class="active"><span>30 Days</span></a></li>
                                                            <li><a href="#"><span>3 Months</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="progress-list gy-3">
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Strater Plan</div>
                                                    <div class="progress-amount">58%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar" data-progress="58" style="width: 58%;">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Silver Plan</div>
                                                    <div class="progress-amount">18.49%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-orange" data-progress="18.49"
                                                        style="width: 18.49%;"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Dimond Plan</div>
                                                    <div class="progress-amount">16%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-teal" data-progress="16"
                                                        style="width: 16%;"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Platinam Plan</div>
                                                    <div class="progress-amount">29%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-pink" data-progress="29"
                                                        style="width: 29%;"></div>
                                                </div>
                                            </div>
                                            <div class="progress-wrap">
                                                <div class="progress-text">
                                                    <div class="progress-label">Vibranium Plan</div>
                                                    <div class="progress-amount">33%</div>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-azure" data-progress="33"
                                                        style="width: 33%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="invest-top-ck mt-auto">
                                            <div class="chartjs-size-monitor">
                                                <div class="chartjs-size-monitor-expand">
                                                    <div class=""></div>
                                                </div>
                                                <div class="chartjs-size-monitor-shrink">
                                                    <div class=""></div>
                                                </div>
                                            </div><canvas class="iv-plan-purchase chartjs-render-monitor"
                                                id="planPurchase" width="591" height="75"
                                                style="display: block; height: 50px; width: 394px;"></canvas>
                                        </div>
                                    </div>
                                </div>
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
    mounted() {
    },
    mixins: [Helpers]
}
</script>

