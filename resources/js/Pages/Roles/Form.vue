<template>
    <form v-if="form" @submit.prevent="submit" enctype="multipart/form-data">
        <div class="card card-bordered card-preview py-5">
                    <!--begin::Label-->
                     <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table tranx">
                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-bold">
                                <!--begin::Table row-->
                                <tr class="tb-tnx-item">
                                    <td class="tb-tnx-id">
                                        <!--begin::Checkbox-->
                                        <div class="custom-control custom-checkbox px-4">
                                            <input class="form-check-input" type="checkbox" value="" @click="selectAll"
                                                v-model="allSelected" id="kt_roles_select_all">
                                            <span class="form-check-label" for="kt_roles_select_all">Select all</span>
                                        </div>
                                        <!--end::Checkbox-->
                                    </td>
                                </tr>
                                <!--end::Table row-->
                                <!--begin::Table row-->
                                <tr v-for="(permission, index) in form.permissions" :key="index" class="tb-tnx-id">
                                    <!--begin::Label-->
                                    <td class="tb-tnx-id text-capitalize font-weight-bold">{{ index }}</td>
                                    <!--end::Label-->
                                    <!--begin::Input group-->
                                    <td class="tb-tnx-id text-capitalize">
                                        <!--begin::Wrapper-->
                                        <div class="custom-control custom-checkbox px-4" v-for="(item, i) in permission" :key="i">
                                            <!--begin::Checkbox-->
                                            <input class="form-check-input" type="checkbox" v-model="item.checked"
                                                    :value="item.id" :checked="item.checked">
                                                <label
                                                    class="form-check-label text-capitalize">{{getGroupName(item.name.split(' ')[0])}}</label>
                                            <!--end::Checkbox-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </td>
                                    <!--end::Input group-->
                                </tr>
                                <!--end::Table row-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <div class="d-flex justify-content-end py-6 px-9">
                        <Button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                            ref="submitButton">
                            <span class="indicator-label" v-if="!form.processing"> Update Changes </span>
                            <span class="indicator-progress" v-if="form.processing">
                                Please wait.
                                <span class="spinner-border spinner-border-sm align-middle ml-2"></span>
                            </span>
                        </Button>
                    </div>
        </div>
    </form>
</template>

<script>
import Input from "@/Components/Input.vue";
import Label from "@/Components/Label.vue";
import Button from "@/Components/Button.vue";
import Error from "@/Components/InputError.vue";
import Helpers from "@/Mixins/Helpers";

export default {
    props: ["role", "rolePermissions", "permissionGroups"],
    components: {
        Input,
        Label,
        Button,
        Error,
    },

    mounted() {
        this.form = this.$inertia.form({
            id: this.role ? this.role.id : "",
            permissions: this.permissionGroups,
            rolePermission: "",
        });
        Object.keys(this.form.permissions).forEach((g) => {
            this.form.permissions[g] = this.form.permissions[g].map((p) => {
                return {
                    ...p,
                    checked: this.rolePermissions.indexOf(p.id) !== -1,
                };
            });
        });
    },

    data() {
        return {
            form: null,
            permissions: this.permissions,
            rolePermissions: this.rolePermissions,
            allSelected: false,
        };
    },

    methods: {
        submit() {
            const rolePermissions = [];
            Object.keys(this.form.permissions).forEach((groupPermission) => {
                this.form.permissions[groupPermission].forEach((permission) => {
                    if (permission.checked) {
                        rolePermissions.push(permission.id);
                    }
                });
            });
            this.form.rolePermission = rolePermissions;
            if (this.role && this.role.id !== "") {
                this.form.put(route("roles.update", this.role.id), {
                    errorBag: "role",
                    preserveScroll: true,
                });
            }
        },
        selectAll: function () {
            if (!this.allSelected) {
                Object.keys(this.form.permissions).forEach((groupPermission) => {
                    this.form.permissions[groupPermission] = this.form.permissions[groupPermission].map((permission) => {
                        return {
                            ...permission,
                            checked: true
                        };
                    });
                });
            } else {
                Object.keys(this.form.permissions).forEach((groupPermission) => {
                    this.form.permissions[groupPermission] = this.form.permissions[groupPermission].map((permission) => {
                        return {
                            ...permission,
                            checked: false
                        };
                    });
                });

            }
        },
    },

    mixins: [Helpers],
};
</script>