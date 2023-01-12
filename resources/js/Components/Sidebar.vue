<template>
  <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
      <div class="nk-menu-trigger">

          <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left" @click="hideSidebar"></em></a>
          <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
      </div>
      <div class="nk-sidebar-brand">
        <Link :href="route('dashboard')" class="logo-link nk-sidebar-logo">
          <ApplicationLogo/>
        </Link>
      </div>
    </div><!-- .nk-sidebar-element -->

    <div class="nk-sidebar-element nk-sidebar-body">
      <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
          <ul class="nk-menu">
            <li class="nk-menu-heading">
              Main
            </li><!-- .nk-menu-item -->

            <li class="nk-menu-item" :class="{ 'active current-page' : route().current('dashboard') }">
              <Link :href="route('dashboard')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                  <span class="nk-menu-text">Dashboard</span>
              </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_plans')" :class="{ 'active current-page': route().current('manage-plan.*') }">
              <Link :href="route('manage-plan.index')" class="nk-menu-link" preserve-scroll>
                <span class="nk-menu-icon"><em class="icon ni ni-repeat-v"></em></span>
                <span class="nk-menu-text">Plan</span>
              </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_reward')" :class="{ 'active current-page': route().current('reward.*') }">
              <Link :href="route('reward.index')" class="nk-menu-link" preserve-scroll>
                <span class="nk-menu-icon"><em class="icon ni ni-repeat-v"></em></span>
                <span class="nk-menu-text">Rewards</span>
              </Link>
            </li>
              <li class="nk-menu-item" v-if="checkUserPermissions('view_commission')" :class="{ 'active current-page': route().current('commission.*') }">
                  <Link :href="route('commission.index')" class="nk-menu-link" preserve-scroll>
                    <span class="nk-menu-icon"><em class="icon ni ni-wallet-fill"></em></span>
                    <span class="nk-menu-text">Commissions</span>
                  </Link>
              </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_permissions')" :class="{ 'active current-page': route().current('administrators.*') }">
                <Link :href="route('administrators.index')" class="nk-menu-link" preserve-scroll>
                    <span class="nk-menu-icon"><em class="icon ni ni-user-list-fill"></em></span>
                    <span class="nk-menu-text">Roles Manager</span>
                </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_roles')" :class="{ 'active current-page': route().current('roles.*') }">
                <Link :href="route('roles.index')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-lock-fill"></em></span>
                  <span class="nk-menu-text">Permission</span>
                </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_users')"  :class="{ 'active current-page': route().current('users.*') }">
                <Link :href="route('users.index')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                  <span class="nk-menu-text">Manage Users</span>
                </Link>
            </li>

            <li class="nk-menu-item" v-if="checkUserPermissions('view_withdrawal')"
            :class="{ 'active current-page': route().current('gateway.*', 'withdrawal') }">
                <Link :href="route('gateway.index', 'withdrawal')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-cash-stack"></em></span>
                  <span class="nk-menu-text">Withdrawal methods  </span>
                </Link>
            </li>

            <li class="nk-menu-item" v-if="checkUserPermissions('view_withdrawal')"
            :class="{ 'active current-page': route().current('withdrawals.index') }">
                <Link :href="route('withdrawals.index')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                  <span class="nk-menu-text">Withdrawals</span>
                </Link>
            </li>

            <li class="nk-menu-item" v-if="checkUserPermissions('view_user_rewards')"
            :class="{ 'active current-page': route().current('rewards.index') }">
                <Link :href="route('rewards.index')" class="nk-menu-link" preserve-scroll>
                  <span class="nk-menu-icon"><em class="icon ni ni-wallet-fill"></em></span>
                  <span class="nk-menu-text">User Rewards</span>
                </Link>
            </li>

            <li class="nk-menu-heading">
              Settings
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub"  :class="{ 'active': route().current('settings.*') }">
              <a href="#" class="nk-menu-link nk-menu-toggle">
                  <span class="nk-menu-icon"><em class="icon ni ni-setting-alt"></em></span>
                  <span class="nk-menu-text">Settings</span>
              </a>
              <ul class="nk-menu-sub">
                  <li v-for="(setting, index) in settings" 
                    :key="index" class="nk-menu-item" 
                    :class="{ 'active current-page': route().current('settings.group', setting.group) }">
                      <Link :href="route('settings.group', setting.group)" class="nk-menu-link" preserve-scroll>
                        <span class="nk-menu-icon"><em class="icon ni ni-dot"></em></span>
                        <span class="nk-menu-text text-capitalize">{{ getGroupName(setting.group) }}</span>
                      </Link>
                  </li>
              </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'
import ApplicationLogo from './ApplicationLogo.vue';
import Helpers from '@/Mixins/Helpers';
import axios from 'axios';
export default {
  data(){
    return {
      'settings': [],
      'open': false
    }
  },
  components: {
    Link,
    ApplicationLogo,
  },
  methods:{
    hideSidebar(){
        let sidebar = document.querySelector('.nk-sidebar')
        sidebar.classList.remove('nk-sidebar-active')
    },
    getSettings(){
      axios.get(route('settings'))
        .then((response) => {
          this.settings = response.data.data
      })
    }
  },
  mounted(){
    NioApp.TGL.init();
    NioApp.sbCompact();
    this.getSettings()
    //  this.emitter.on('open-sidebar', ()=>{
    //     this.open = this.open ? false : true
    //  });
  },
  mixins: [Helpers]
}
</script>
