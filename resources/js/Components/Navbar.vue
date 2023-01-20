<template>
     <div class="nk-header nk-header-fixed is-light">
        <div class="container-fluid">
            <div class="nk-header-wrap">
                <div class="nk-menu-trigger d-xl-none ml-n1" @click="showSidebar">
                    <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                </div>
                <div class="nk-header-brand d-xl-none">
                    <Link :href="route('dashboard')" class="logo-link">
                        <img class="logo-light logo-img" :src="getImage('logo.png')" alt="logo">
                    </Link>
                </div><!-- .nk-header-brand -->
                <div class="nk-header-news d-none d-xl-block">
                    <div class="nk-news-list">
                        <a class="nk-news-item" href="#">
                            <div class="nk-news-icon">
                                
                            </div>
                            <div class="nk-news-text">
                                
                            </div>
                        </a>
                    </div>
                </div><!-- .nk-header-news -->
                <div class="nk-header-tools">
                    <ul class="nk-quick-nav">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <div class="user-toggle">
                                    <div class="user-avatar sm">
                                        <em class="icon ni ni-user-alt"></em>
                                    </div>
                                    <div class="user-info d-none d-md-block">
                                        <div class="user-status">Administrator</div>
                                        <div class="user-name dropdown-indicator">{{ admins ? admins.name: '' }}</div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1" style="position: absolute!important;">
                                <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                    <div class="user-card">
                                        <div class="user-avatar">
                                            <span>{{ getAbbrevation($page.props.auth.user.name) }}</span>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ $page.props.auth.user.name }}</span>
                                            <span class="sub-text">{{ $page.props.auth.user.email }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                                        <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                        <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                                        <li><a class="dark-switch" :href="void(0)"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                    </ul>
                                </div>
                                <div class="dropdown-inner">
                                    <ul class="link-list">
                                        <li>
                                            <Link
                                                class="btn btn-danger"
                                                :href="route('logout')"
                                                method="post"
                                                as="button"
                                            >
                                                Log Out
                                            </Link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li><!-- .dropdown -->
                    </ul><!-- .nk-quick-nav -->
                </div><!-- .nk-header-tools -->
            </div><!-- .nk-header-wrap -->
        </div><!-- .container-fliud -->
    </div>
</template>

<script>
import Dropdown from '@/Components/Dropdown.vue';
import Helpers from '@/Mixins/Helpers';
import { Link } from '@inertiajs/inertia-vue3'
export default {
    props: ['admins'],
    components: {
        Dropdown,
        Link
    },
    methods:{
        // showSidebar(){
        //     let sidebar = document.querySelector('.nk-sidebar')
        //     sidebar.classList.add('nk-sidebar-active')
        // },
        // changeTheme(){
        //     NioApp.ModeSwitch()
        // }
    },
    mounted(){
        NioApp.ModeSwitch();
    },
    mixins: [Helpers]
}
</script>

<style>

</style>