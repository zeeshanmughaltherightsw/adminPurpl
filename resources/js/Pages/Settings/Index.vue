<template>
    <Head :title="getTitle" />
    <Authenticated>
        <breadcrumb :title="getTitle" class="text-capitalize" />
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <form @submit.prevent="submit">
                    <div class="row">
                        <div v-for="(setting, index) in settings" :key="setting.id" class="col-md-6 col-sm-12 mt-3">
                            <vue-toggle
                                v-if="form.settings[index].type == 'checkbox' && checkUserPermissions('edit_settings')"
                                :title="form.settings[index].name" :name="form.settings[index].name"
                                :value=booleanStatusValue(form.settings[index].key) @toggle="toggle($event, index)" 
                            />
                            <div class="form-group" v-if="setting.type == 'file'"> 
                                <label class="form-label" :for="form.settings[index].key">{{ form.settings[index].name }}</label>
                                <div class="form-control-wrap">
                                    <div class="form-file d-flex"> 
                                        <input  
                                            type="file" 
                                            class="form-file-input" 
                                            :id="form.settings[index].key" 
                                            @input="form.settings[index].value = $event.target.files[0]"
                                        />
                                        <img :src="form.settings[index].value" class="img-fluid" style="max-width: 100px; height:20px"/> 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" v-if="setting.type == 'select'"> 
                                <label class="form-label" :for="form.settings[index].key">{{ form.settings[index].name }}</label>
                                <div class="form-control-wrap">
                                    <select v-model="form.settings[index].value" class="form-control mb-3">
                                        <option v-for="(item) in JSON.parse(setting.options)">{{ item }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" v-else>
                                <Label :for="form.settings[index].key">{{ form.settings[index].name }}</Label>
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <Input 
                                            :placeholder="form.settings[index].name" 
                                            :id="setting.key"
                                            :type="setting.type" class="form-control"
                                            :required="form.settings[index].is_required" 
                                            v-model="form.settings[index].value"
                                        />
                                    </div>
                                </div>
                                <!-- <error :message="form.error.settings[index].key" /> -->
                            </div>
                        </div>
                        <div class="col-lg-12 py-2 d-flex justify-content-end">
                            <Button type="submit" :style="{ 'opacity: 0.5': form.processing }"
                                :disabled="form.processing">
                                <span class="indicator-label" v-if="!form.processing">Update</span>
                                <span class="indicator-progress" v-if="form.processing">
                                    <span class="spinner-border spinner-border-sm align-middle"></span>
                                </span>
                            </Button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </Authenticated>
</template>

<script>
import Helpers from '@/Mixins/Helpers';
import Authenticated from '@/Layouts/Authenticated.vue'
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import error from '@/Components/InputError.vue';
import Button from '@/Components/Button.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import VueToggle from 'vue-toggle-component';
import Breadcrumb from '@/Components/Breadcrumb.vue';

export default {
    props: ["settings"],
    data() {
        return {
            form: null
        };
    },
    components: {
        Authenticated,
        error,
        Input,
        Label,
        Button,
        ValidationErrors,
        VueToggle,
        Head,
        Breadcrumb
    },
    methods: {
        submit() {
            this.form.post(route('settings.group.update'), {
                errorBag: "setting",
                preserveScroll: true,
                // onSuccess: () => {
                //     NioApp.Toast('Settings updated!', 'success');
                // }
            })
        },
        toggle(e, index) {
            this.form.settings[index].value = e ? '1' : '0';
        },
    },

    beforeMount() {
        this.form = useForm({
            settings: this.settings
        })
    },
    computed: {
        getTitle() {
            return this.getGroupName(this.form.settings[0].group).toLowerCase()
        }
    },
    mixins: [Helpers]

}
</script>

<style>

</style>