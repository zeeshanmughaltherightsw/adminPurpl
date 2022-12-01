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
                <div class="form-control-wrap">
                    <label for="">Password</label>
                  <a
                    href="#"
                    class="form-icon form-icon-right passcode-switch lg"
                    data-target="password"
                  >
                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                  </a>
                  <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full form-control form-control-lg"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Enter your password"
                  />
                  <InputError class="mt-2" :message="form.errors.password" />
                </div>
              </div>
              <div class="form-group">
                <PrimaryButton
                  class="btn btn-lg btn-primary site-color"
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
