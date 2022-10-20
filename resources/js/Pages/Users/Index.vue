<template>
<Head title="Manage Users"/>
<Authenticated>
    <breadcrumb title="Manage Users" :subTitle="`Total Users ${users.total}`">
        <template #breadcrumbplugin>
            <li>
                <SearchInput :searchedKeyword="searchedKeywords" callType='users'/>
            </li>
        </template>
    </breadcrumb>
    <div class="card">
        <div class="card-body py-3">
            <UserList :users="users" />
        </div>
        <pagination :meta="users" :keyword="searchedKeywords" callType="users" />
    </div>      
</Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '../../Layouts/Authenticated.vue';
import EditSection from '@/Components/EditSection.vue';
import { Head } from '@inertiajs/inertia-vue3';
import SearchInput from '@/Components/SearchInput.vue';
import Pagination from '@/Components/Pagination.vue'
import Button from '@/Components/Button.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import UserList from '@/Components/UserList.vue';
export default {
    props: ['users' , 'searchKeyword'],
    data(){
        return {
            searchedKeywords: this.searchKeyword,
            isShow: false,
        }
    },
    components: 
    {
        Authenticated,
        EditSection,
        Head,
        SearchInput,
        Pagination,
        Button,
        Breadcrumb,
        UserList
    },
    methods: {
        openModal(user = null){
            this.isShow = true;
            this.emitter.emit('user_modal', {
                title: user ? "Edit user plan" : 'Add user plan',
                user: user 
            });
        }
    },
    mixins: [Helpers]
}
</script>

<style>

</style>