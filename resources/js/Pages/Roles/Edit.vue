<template>
  <head title="Roles and permissiosn" />
  <AuthenticatedLayout>
    <Breadcrumb title="Roles and Permissions" />
    <div>
      <div class="nk-block nk-block-lg">
        <div class="nk-block-head-content">
            <p>Permissions for <strong class="text-capitalize">{{ role.name }}</strong>.</p> 
          </div>
        <role-form :role="role" :permissionGroups="permissionGroups" :rolePermissions="rolePermissions"></role-form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import AuthenticatedLayout from "@/Layouts/Authenticated.vue";
import RoleForm from "./Form.vue";
import Breadcrumb from "@/Components/Breadcrumb.vue";
export default {
  components: {
    Head,
    AuthenticatedLayout,
    RoleForm,
    Breadcrumb
},
  props: ["role", 'permissionGroups', 'rolePermissions'],
};
</script>