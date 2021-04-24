<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <nav aria-label="Page navigation example" class="d-flex" v-if="users.links.length > 3">
                        <ul class="pagination m-auto">
                            <li class="page-item" v-if="users.links.length > 1" v-for="link in users.links"
                                :key="'user_pagination_link_' + link.label"
                                v-bind:class="{'disabled': link.active || !link.url}"
                            >
                                <inertia-link class="page-link" :href="link.url" v-if="link.url" v-html="link.label"></inertia-link>
                                <span v-else class="page-link" v-html="link.label"></span>
                            </li>
                        </ul>
                    </nav>
                    <table class="table table-hover table-responsive-lg">
                        <caption>List of users</caption>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Photo</th>
                                <th>Registration Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr v-for="user in users.data" :key="'user_' + user.id">
                            <td>{{user.id}}</td>
                            <td>{{user.name}}</td>
                            <td>{{user.email}}</td>
                            <td><img :src="user.photo" v-if="user.photo" style="max-height: 100px;max-width: 100px"><p v-else>-</p></td>
                            <td>{{formatDate(user.registration_date)}}</td>
                            <td><inertia-link :href="'/users/' + user.id" class="btn btn-sm btn-primary">Details</inertia-link></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import helperMixin from "../mixins/helperMixin";

export default {
    name: "Users",
    mixins: [helperMixin],
    components: {
        AppLayout,
    },
    props: {
        users: {
            type: Object,
            default: null,
        }
    },
    created() {
    },
    data(){
        return {

        }
    },
    computed: {
    }
}
</script>

<style scoped>

</style>
