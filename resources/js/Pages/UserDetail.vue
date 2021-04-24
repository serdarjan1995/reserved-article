<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                User Detail
            </h2>
        </template>
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="row">
                        <div class="col">
                            <p>Author: {{ userDetail.data.name }}</p>
                            <p>Email: {{ userDetail.data.email }}</p>
                            <p>Articles: {{ userDetail.data.news.length }}</p>

                        </div>
                        <div class="col">
                            <img class="float-right" :src="userDetail.data.photo" v-if="userDetail.data.photo" style="max-height: 200px;max-width: 200px">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <table class="table table-hover table-responsive-lg">
                        <caption>List of articles by {{ userDetail.data.name }}</caption>
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Image</th>
                            <th>Creation Date</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="news in userDetail.data.news" :key="'news_' + news.id">
                            <td>{{ news.id }}</td>
                            <td>{{ news.title }}</td>
                            <td>{{ stripText(news.content) }}</td>
                            <td><img :src="news.image" v-if="news.image" style="max-height: 100px;max-width: 100px">
                                <p v-else>-</p></td>
                            <td>{{ formatDate(news.creation_date) }}</td>
                            <td>
                                <inertia-link :href="'/news/' + news.id" class="btn btn-sm btn-primary">Go To Article
                                </inertia-link>
                            </td>
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
    name: "UserDetail",
    mixins: [helperMixin],
    components: {
        AppLayout,
    },
    props: {
        userDetail: {
            type: Object,
            default: null,
        }
    },
    created() {
    },
    data() {
        return {}
    },
    computed: {}
}
</script>

<style scoped>

</style>
