<template>
    <Head title="Plans"/>
<Authenticated>
    <breadcrumb title="Plans" :subTitle="`Total Plans ${plans.total}`">
    <template #breadcrumbplugin>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">Open modal for @getbootstrap</button>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
    </template>
    </Breadcrumb>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table dataTable no-footer dtr-inline">  
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Profit %age</th>
                        <th scope="col">Profit Bonus %age</th>
                        <th scope="col">Amount Return</th>
                        <th scope="col">Validity</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="plan in plans.data" :key="plan.id">
                        <td data-label="Name">{{plan.name}}</td>
                        <td data-label="Price" class="font-weight-bold">{{ plan.min_price }} to {{ plan.max_price }} </td>

                        <td data-label="Profit %age">{{ plan.min_profit_percent }} % to {{ plan.max_profit_percent }} %</td>
                        <td data-label="Profit Bonus %age">{{ plan.profit_bonus_percent }} %</td>
                        <td data-label="amount return">{{ plan.amount_returns }} Days</td>
                        <td data-label="Validity">{{ plan.validity}} Day</td>
                        <td data-label="Status">
                            <span class="badge" :class="getStatusForTable(plan.status)">{{plan.status}}</span>
                        </td>
                        <td data-label="Action">
                            <edit-section iconType="link" 
                                permission="edit_plans"
                                :url="route('manage-plan.edit', plan.id)"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
import Breadcrumb from '@/Components/Breadcrumb.vue';
export default {
    props: ['plans' , 'searchKeyword'],
    data(){
        return {
            searchedKeywords: this.searchKeyword
        }
    },
    components: {
                Authenticated,
                EditSection,
                Head,
                SearchInput,
                Pagination,
                Breadcrumb
            },
    mounted(){
        window.NioApp.DataTable.init()
    },
    mixins: [Helpers]
}
</script>

<style>

</style>