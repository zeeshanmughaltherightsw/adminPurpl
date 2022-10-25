<script setup>
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";


const form = useForm({
    name: "",
    price: "",
    profit: "",
    amount_returns: "",
    status: ""
});

const submit = () => {
    form.post(route("manage-plan.store"), {
    });
};
</script>

<template>
    <Modal title="Create plan">
        <form @submit.prevent="submit" class="form-validate is-alter">
            <div class="form-group">
                <label class="form-label" for="full-name">Name*</label>
                <div class="form-control-wrap">
                    <Input id="name" type="text" class="mt-1 block w-full form-control form-control-lg"
                        v-model="form.name" required autofocus autocomplete="name" />
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="full-name">Price*</label>
                <div class="form-control-wrap">
                    <Input id="price" type="text" class="mt-1 block w-full form-control form-control-lg"
                        v-model="form.price" required autofocus autocomplete="price" />
                </div>
            </div>


            <div class="form-group">
                <label class="form-label" for="full-name">Profit*</label>
                <div class="form-control-wrap">
                    <Input id="profit" type="text" class="mt-1 block w-full form-control form-control-lg"
                        v-model="form.profit" required autofocus autocomplete="profit" />
                </div>
            </div>


            <div class="form-group">
                <label class="form-label" for="full-name">Amount Returns*</label>
                <div class="form-control-wrap">
                    <Input id="amount_returns" type="text" class="mt-1 block w-full form-control form-control-lg"
                        v-model="form.amount_returns" required autofocus autocomplete="amount_returns" />
                </div>
            </div>

        
                <VueToggle title="Toggle me" v-model="form.status" name="VueToggle" @toggle="doSomething" />
          

            <div class="form-group d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center">Submit</button>
            </div>



        </form>
    </Modal>
</template>

<script>
import VueToggle from "vue-toggle-component";
import Modal from '@/Components/Modal.vue';
import Button from '@/Components/Button.vue'
import Input from '@/Components/Input.vue';
export default {
    name: 'App',
    components: { Modal, Button, Input, VueToggle },
    methods: {
        doSomething(value) {
            // value = true || false.
        }
    },
}
</script>

<style>

</style>