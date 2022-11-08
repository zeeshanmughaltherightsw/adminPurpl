<template>

    <Head :title="`${user.name} - Edit User`" />
    <Authenticated>
        <breadcrumb title="Manage Users" />
        <div class="row mb-none-30">
            <div class="col-xl-3 col-lg-5 col-md-5 mb-30">
                <div class="card b-radius--10 overflow-hidden box--shadow1">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="https://aamearning.com/assets/images/default.png" alt="profile-image"
                                class="b-radius--10 w-100">
                        </div>
                        <div class="mt-3">
                            <h5 class="">{{ user.name }}</h5>
                            <span class="text--small">Joined At<br /><strong>{{ formatDateTime(user.created_at)
                            }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                    <div class="card-body px-1">
                        <p class="mb-20 text-muted">User information</p>
                        <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Username<span class="font-weight-bold">{{ user.username }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Status<span class="badge badge-pill bg--success">{{ user.status }}</span></li>

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Balance<span class="font-weight-bold">{{ user.investment }} USD</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center"
                                v-if="user.referredBy">
                                Referred By<span class="font-weight-bold">{{ user.referred_by.username }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Referral<span class="font-weight-bold">
                                    <a href="https://aamearning.com/wuas-admin/user/total-referral/13451">
                                        {{ user.referrals_count }} User</a>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Total Commissions<span class="font-weight-bold">
                                    <a href="https://aamearning.com/wuas-admin/user/commissions/13451"> 0 USD</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-5 col-md-5">
                <div class="card">
                    <div class="card pricing">
                        <div class="pricing-head">
                            <div class="pricing-title">
                                <h4 class="card-title title">{{user.plan?.name}}</h4>
                            </div>
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-3"> <span class="h4 fw-500">1.67%</span> 
                                        <span class="sub-text">Total Deposit</span> 
                                    </div>
                                    <div class="col-3"> 
                                        <span class="h4 fw-500">30</span> 
                                        <span class="sub-text">Total Withdraw</span> 
                                    </div>
                                    <div class="col-3"> 
                                        <Link :href="route('users.transactions', user.id)">
                                            <span class="h4 fw-500">{{user.transactions_count}}</span> 
                                            <span class="sub-text">Total Transactions</span>
                                        </Link> 
                                    </div>
                                    <div class="col-3"> 
                                        <span class="h4 fw-500">30</span> 
                                        <span class="sub-text">Total Withdraw</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="card-body mt-3">
                            <div class="card-title">
                                <h4 class="title">{{user.name}}<span class="text-muted ml-1" style="font-size: 14px;">(information)</span></h4>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        <label class="form-label" for="default-01"
                                            >Fullname</label
                                        >
                                        </div>
                                        <div class="form-control-wrap">
                                        <Input
                                            id="email"
                                            type="text"
                                            class="mt-1 block w-full form-control form-control-lg"
                                            v-model="form.name"
                                            required
                                            autofocus
                                            autocomplete="name"
                                        />
                                        <Error class="mt-2" :message="form.errors.name" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        <label class="form-label" for="default-01"
                                            >Mobile</label
                                        >
                                        </div>
                                        <div class="form-control-wrap">
                                        <Input
                                            id="email"
                                            type="text"
                                            class="mt-1 block w-full form-control form-control-lg"
                                            v-model="form.phone_no"
                                            required
                                            autofocus
                                            autocomplete="phone_no"
                                        />
                                        <Error class="mt-2" :message="form.errors.phone_no" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 col-sm-12 mt-1">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        <label class="form-label" for="default-01"
                                            >Email</label
                                        >
                                        </div>
                                        <div class="form-control-wrap">
                                        <Input
                                            id="email"
                                            type="text"
                                            class="mt-1 block w-full form-control form-control-lg"
                                            v-model="form.email"
                                            required
                                            autofocus
                                            autocomplete="email"
                                        />
                                        <Error class="mt-2" :message="form.errors.email" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-md-12 col-12 mt-1">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                        <label class="form-label" for="default-01"
                                            >Address</label
                                        >
                                        </div>
                                        <div class="form-control-wrap">
                                        <Input
                                            id="email"
                                            type="text"
                                            class="mt-1 block w-full form-control form-control-lg"
                                            v-model="form.address"
                                            required
                                            autofocus
                                            autocomplete="address"
                                        />
                                        <Error class="mt-2" :message="form.errors.address" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mt-3">
                                    <vue-toggle
                                        title="Email Verifications" name="Email Verifications"
                                        :toggled="form.ev"
                                        @toggle="toggle('ev')" />
                                </div>
                                <div class="col-4 mt-3">
                                    <vue-toggle
                                        title="Email Verifications" name="Mobile Verifications"
                                        :toggled="form.mv"
                                        @toggle="toggle('mv')" />
                                </div>
                                <div class="col-4 mt-3">
                                    <vue-toggle
                                        title="Email Verifications" name="Two Factor Verifications"
                                        :toggled="form.two_fa"
                                        @toggle="toggle('two_fa')" />
                                </div>
                                        <div class="col-md-12 d-flex justify-content-end">
                                        <div class="d-flex justify-content-end py-6 px-9 mt-3">
                                            <Button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                                ref="submitButton">
                                                <span class="indicator-label" v-if="!form.processing">{{ form.id ? "Update" :
                                                        "Create"
                                                }}</span>
                                                <span class="indicator-progress" v-if="form.processing">
                                                    Please wait.
                                                    <span class="spinner-border spinner-border-sm align-middle ml-2"></span>
                                                </span>
                                            </Button>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Authenticated>
</template>
<script>
import Helpers from '@/Mixins/Helpers';
import { Head, useForm, Link } from '@inertiajs/inertia-vue3';
import Button from '@/Components/Button.vue';
import Authenticated from '../../Layouts/Authenticated.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import Error from "@/Components/InputError.vue";
import Label from "@/Components/Label.vue";
import Input from "@/Components/Input.vue";
import PrimaryButton from "@/Components/Button.vue";
import VueToggle from 'vue-toggle-component';
export default {
    props: ['user'],
    data(){
        return {
            form: null,
        }
    },
    components: { Authenticated, Button, Head, Breadcrumb, PrimaryButton, Input, Label, Error, VueToggle, Link},
    methods: {
        submit(){
            this.form.put(route('users.update', this.user.id),{
                preserveScroll: true,
                onSuccess: () => {
                    NioApp.Toast('User profile updated!', 'success');
                }
            });
        },
        toggle(key){
            this.form[key] = !this.form[key]
        }
    },
    beforeMount(){
        this.form = useForm({
            id: this.user.id,
            username: this.user.username,
            name: this.user.name,
            email: this.user.email,
            phone_no: this.user.phone_no,
            ev: this.user.ev == 1 ? true : false,
            mv: this.user.mv == 1 ? true : false,
            two_fa: this.user.two_fa == 1 ? true : false,
            address: this.user.address
        })
    },
    mixins: [Helpers]
}
</script>
