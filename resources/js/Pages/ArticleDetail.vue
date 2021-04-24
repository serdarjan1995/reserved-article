<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Article
            </h2>
        </template>
        <div class="pt-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="row">
                        <div class="col-8">
                            <div class="row">
                                <img class="float-right" :src="article.data.image" v-if="article.data.image" style="max-height: 250px;max-width: 250px">
                                <h3>{{ article.data.title }}</h3>
                            </div>
                        </div>
                        <div class="col-4 float-right">
                            <img :src="article.data.author_photo" v-if="article.data.author_photo" style="max-height: 100px;max-width: 100px">
                            <p>Author: <inertia-link :href="'/users/' + article.data.author">{{ article.data.author_name }}</inertia-link></p>
                            <p>Email: {{ article.data.author_email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <p>{{ article.data.content }}</p>
                    </div>
                    <button class="btn btn-danger" v-if="$page.props.user && $page.props.user.id === article.data.author" @click="deleteSubmit">Delete</button>
                    <inertia-link class="btn btn-primary" v-if="$page.props.user && $page.props.user.id === article.data.author"
                                  :href="'/news/' + article.data.id + '/edit'">
                        Edit
                    </inertia-link>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import helperMixin from "../mixins/helperMixin";
import Button from "../Jetstream/Button";

export default {
    name: "ArticleDetail",
    mixins: [helperMixin],
    components: {
        Button,
        AppLayout,
    },
    props: {
        article: {
            type: Object,
            default: null,
        }
    },
    created() {
    },
    data() {
        return {}
    },
    computed: {},
    methods:{
        deleteSubmit(){
            this.$inertia.delete('')
        }
    }
}
</script>

<style scoped>

</style>
