<template>
  <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
    <div class="nk-sidebar-element nk-sidebar-head">
      <div class="nk-menu-trigger">
          <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
          <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
      </div>
      <div class="nk-sidebar-brand">
        <a href="{{route('admin.dashboard')}}" class="logo-link nk-sidebar-logo">
          <ApplicationLogo/>
        </a>
      </div>
    </div><!-- .nk-sidebar-element -->
    <div class="nk-sidebar-element nk-sidebar-body">
      <div class="nk-sidebar-content">
        <div class="nk-sidebar-menu" data-simplebar>
          <ul class="nk-menu">
            <li class="nk-menu-heading">
              
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
              <Link :href="route('dashboard')" class="nk-menu-link">
                  <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                  <span class="nk-menu-text">Dashboard</span>
              </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_plans')">
                <Link :href="route('manage-plan.index')" class="nk-menu-link">
                  <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                  <span class="nk-menu-text">Plan</span>
                </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_permissions')">
                <Link :href="route('administrators.index')" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>      
                    <span class="nk-menu-text">Roles Manager</span>
                </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_roles')">
                <Link :href="route('roles.index')" class="nk-menu-link">
                  <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                  <span class="nk-menu-text">Permission</span>
                </Link>
            </li>
            <li class="nk-menu-item" v-if="checkUserPermissions('view_users')">
                <Link :href="route('users.index')" class="nk-menu-link">
                  <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                  <span class="nk-menu-text">Manage Users</span>
                </Link>
            </li>
            <!-- <li v-if="checkUserPermissions('view_settings')" class="sidebar-menu-item sidebar-dropdown nav-item dropdown" :class="[route().current('settings.*') ? 'show' : '']">
                <a href="javascript:void(0)" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false" :class="[route().current('settings.*') ? 'active' : '']">
                  <span class="nk-menu-text">Settings</span>
                </a>
                <div class="sidebar-submenu dropdown-menu" :class="[route().current('settings.*') ? 'show' : '']">
                    <ul>
                        <li v-for="setting in settings" :key="setting.id"  class="nk-menu-item" :class="[route().current('settings.*') ? 'active' : '']">
                            <Link :href="route('settings.group', setting.group)" :only="['settings']" class="text-capitalize">
                              <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>  
                              <span class="menu-title ml-3">{{ getGroupName(setting.group) }}</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </li> -->
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
    getSettings(){
      axios.get(route('settings'))
        .then((response) => {
          this.settings = response.data.data
      })
    }
  },
  mounted(){
    this.getSettings()
    //  this.emitter.on('open-sidebar', ()=>{
    //     this.open = this.open ? false : true
    //  });
  },
  mixins: [Helpers]
}
</script>