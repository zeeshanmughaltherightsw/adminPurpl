<script setup>
import Footer from '../Components/Footer.vue';
import Sidebar from '../Components/Sidebar.vue';
import Navbar from '../Components/Navbar.vue';
import Banner from '@/Components/Banner.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
</script>

<template>
    <div class="nk-app-root">
        <div class="nk-main ">
            <Sidebar/>
            <div class="nk-wrap ">
                <Navbar/>
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <Banner/>
                                <slot/>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>
</template>
