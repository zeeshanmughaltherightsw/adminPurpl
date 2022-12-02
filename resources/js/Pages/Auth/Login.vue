<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/Label.vue";
import TextInput from "@/Components/Input.vue";
import PrimaryButton from "@/Components/Button.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";
defineProps({
  canResetPassword: Boolean,
  status: String,
});

const form = useForm({
  username: "",
  password: "",
  remember: false,
});

const submit = () => {
  form.post(route("login"), {
    onFinish: () => form.reset("password"),
  });
};
</script>

<template>
    <Head title="Log in" />
    <div class="nk-content" style="height: 100vh">
<div class="text-center">
    <img src="https://stonearn.com/logo.png" alt="">
</div>
<div class="nk-block nk-block-middle nk-auth-body wide-xs">
        <div class="card shadow-lg">
          <div class="card-inner card-inner-lg">
            <h3 class="mb-4" style="color:#6f5ea9;">Admin Panel</h3>
            <form @submit.prevent="submit">
              <div class="form-group">
                <div class="form-label-group">
                  <label class="form-label" for="default-01"
                    >Username</label>
                </div>
                <div class="form-control-wrap">
                  <TextInput
                    id="email"
                    type="text"
                    class="mt-1 block w-full form-control form-control-lg"
                    v-model="form.username"
                    required
                    autofocus
                    autocomplete="username"
                  />
                  <InputError class="mt-2" :message="form.errors.username" />
                </div>
              </div>
              <div class="form-group">
                <div class="form-label-group">
                    <label class="form-label" for="password">Passcode</label>
                    <a class="link link-primary link-sm" href="html/pages/auths/auth-reset-v2.html">Forgot Code?</a>
                </div>
                <div class="form-control-wrap">
                    <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                        <em class="passcode-icon icon-show icon ni ni-eye"></em>
                        <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                    </a>
                    <input type="password" class="form-control form-control-lg" id="password" placeholder="Enter your passcode">
                </div>
            </div>
              <div class="form-group">
                <PrimaryButton
                  class="btn btn-lg site-color float-center"
                  :class="{ 'opacity-25': form.processing }"
                  :disabled="form.processing"
                >
                  Sign in
                </PrimaryButton>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</template>
