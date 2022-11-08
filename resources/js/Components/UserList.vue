<template>
    <div class="nk-tb-list nk-tb-ulist is-compact">
        <div class="nk-tb-item nk-tb-head">
            <div class="nk-tb-col"><span class="sub-text">Full name</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Username</span></div>
            <div class="nk-tb-col tb-col-sm"><span class="sub-text">Email</span></div>
            <div class="nk-tb-col tb-col-md"><span class="sub-text">Phone</span></div>
            <!-- <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Ip</span></div> -->
           <!-- <div class="nk-tb-col tb-col-xxl"><span class="sub-text">Last Login</span></div> -->
            <div class="nk-tb-col"><span class="sub-text">Status</span></div>
            <!-- <div class="nk-tb-col nk-tb-col-tools text-right">
                <div class="dropdown">
                    <a href="#" class="btn btn-xs btn-outline-light btn-icon dropdown-toggle" data-toggle="dropdown" data-offset="0,5"><em class="icon ni ni-plus"></em></a>
                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                        <ul class="link-tidy sm no-bdr">
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="bl">
                                    <label class="custom-control-label" for="bl">Balance</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" checked="" id="ph">
                                    <label class="custom-control-label" for="ph">Phone</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="vri">
                                    <label class="custom-control-label" for="vri">Verified</label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-control custom-control-sm custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="st">
                                    <label class="custom-control-label" for="st">Status</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div> -->
        </div><!-- .nk-tb-item -->
        <div class="nk-tb-item" v-for="(user, index) in users.data" :key="index">
            <div class="nk-tb-col">
                <div class="user-card">
                    <div class="user-avatar xs bg-primary">
                        <span>AB</span>
                    </div>
                    <div class="user-name">
                        <span class="tb-lead">{{user.name}}</span>
                    </div>
                </div>
            </div>
            <div class="nk-tb-col tb-col-sm">
                <span>{{user.username}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{user.email}}</span>
            </div>
            <div class="nk-tb-col tb-col-md">
                <span>{{user.phone_no}}</span>
            </div>
            <!-- <div class="nk-tb-col tb-col-lg">
                <ul class="list-status">
                    <li><em class="icon text-success ni ni-check-circle"></em> <span>Email</span></li>
                </ul>
            </div> -->
            <!-- <div class="nk-tb-col tb-col-xxl">
                <span>10 Feb 2020</span>
            </div> -->
            <div class="nk-tb-col">
                <span class="tb-status text-capitalize" :class="getStatusForTable(user.status)">{{user.status}}</span>
            </div>
            <div class="nk-tb-col nk-tb-col-tools">
                <ul class="nk-tb-actions gx-2">
                    <!-- <li class="nk-tb-action-hidden">
                        <a href="#" class="btn btn-sm btn-icon btn-trigger" data-toggle="tooltip" data-placement="top" title="Wallet">
                            <em class="icon ni ni-wallet-fill"></em>
                        </a>
                    </li>
                    <li class="nk-tb-action-hidden">
                        <a href="#" class="btn btn-sm btn-icon btn-trigger" data-toggle="tooltip" data-placement="top" title="Send Email">
                            <em class="icon ni ni-mail-fill"></em>
                        </a>
                    </li>
                    <li class="nk-tb-action-hidden">
                        <a href="#" class="btn btn-sm btn-icon btn-trigger" data-toggle="tooltip" data-placement="top" title="Suspend">
                            <em class="icon ni ni-user-cross-fill"></em>
                        </a>
                    </li> -->
                    <li>
                        <div class="drodown">
                            <a href="#" class="btn btn-sm btn-icon btn-trigger dropdown-toggle" data-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <ul class="link-list-opt no-bdr">
                                    <li><Link :href="route('users.edit', user.id)"><em class="icon ni ni-eye"></em><span>View Details</span></Link></li>
                                    <!-- <li><a href="#"><em class="icon ni ni-repeat"></em><span>Orders</span></a></li> -->
                                    <li class="divider"></li>
                                    <!-- <li><a href="#"><em class="icon ni ni-shield-star"></em><span>Reset Pass</span></a></li> -->
                                    <!-- <li><a href="#"><em class="icon ni ni-shield-off"></em><span>Reset 2FA</span></a></li> -->
                                    <li><a href="#"><em class="icon ni ni-na"></em><span>Suspend User</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: ['users'],
    components: {Link},
    mixins: [Helpers]
}
</script>

<style>

</style>