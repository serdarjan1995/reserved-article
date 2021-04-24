<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                News
            </h2>

            <inertia-link class="btn btn-success" href="/news/create" v-if="$page.props.user">Create New Article</inertia-link>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <nav aria-label="Page navigation example" class="d-flex" v-if="news.links.length > 3">
                        <ul class="pagination m-auto">
                            <li class="page-item" v-if="news.links.length > 1" v-for="link in news.links"
                                :key="'news_pagination_link_' + link.label"
                                v-bind:class="{'disabled': link.active || !link.url}"
                            >
                                <inertia-link class="page-link" :href="link.url" v-if="link.url" v-html="link.label"></inertia-link>
                                <span v-else class="page-link" v-html="link.label"></span>
                            </li>
                        </ul>
                    </nav>
                    <table class="table table-hover table-responsive-lg">
                        <caption>List of articles</caption>
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
                        <tr v-for="article in news.data" :key="'article_' + article.id">
                            <td>{{article.id}}</td>
                            <td>{{article.title}}</td>
                            <td>{{stripText(article.content)}}</td>
                            <td><img :src="article.image" v-if="article.image" style="max-height: 100px;max-width: 100px"><p v-else>-</p></td>
                            <td>{{formatDate(article.creation_date)}}</td>
                            <td><inertia-link :href="'/news/' + article.id" class="btn btn-sm btn-primary">Read</inertia-link></td>
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
    name: "News",
    mixins: [helperMixin],
    components: {
        AppLayout,
    },
    props: {
        news: {
            type: Object,
            default: null,
        }
    },
    created() {
        console.log(this.$page.props)
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
