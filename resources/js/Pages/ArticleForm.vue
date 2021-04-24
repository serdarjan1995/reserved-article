<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ getPageTitle }}
            </h2>
        </template>
        <div class="pt-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" v-model="form.title" class="form-control" id="title" aria-describedby="titleHelp">
                            <div id="titleHelp" class="form-text">Article Title</div>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" v-model="form.content" id="content" aria-describedby="contentHelp"></textarea>
                            <div id="contentHelp" class="form-text">Article Content</div>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" v-on:change="onFileChange" accept="image/*" class="form-control" id="image" aria-describedby="imageHelp">
                            <div id="imageHelp" class="form-text">(optional)</div>
                            <img v-if="form.image" :src="getImagePreview" width="100" height="100" style="object-fit: cover" alt="image preview"/>
                        </div>
                        <button class="btn btn-success" @click="submit">{{getButtonName}}</button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout";
import helperMixin from "../mixins/helperMixin";
import Input from "../Jetstream/Input";
import Button from "../Jetstream/Button";

export default {
    name: "ArticleForm",
    mixins: [helperMixin],
    components: {
        Button,
        Input,
        AppLayout,
    },
    props: {
        article: {
            type: Object,
            default: null,
        },
        create: {
            type: Boolean,
            default: false,
        }
    },
    created() {
        if (this.article && this.article.data.author === this.$page.props.user.id){
            this.form.title = this.article.data.title
            this.form.content = this.article.data.content
            this.form.image = this.article.data.image
        }
    },
    data() {
        return {
            form: {
                title: '',
                content: '',
                image: null,
            },
            imagePreview: null,
        }
    },
    computed: {
        getPageTitle() {
            if (this.create){
                return 'Create New Article'
            }
            return 'Edit Article'
        },
        getButtonName(){
            if (this.create){
                return 'Add'
            }
            return 'Save'
        },
        getImagePreview: function (){
            if (this.form.image && !this.imagePreview){
                return this.form.image
            }
            else{
                return this.imagePreview
            }
        }
    },
    methods: {
        submit(){
            if (this.create){
                this.$inertia.post('/news', this.form)
            }
            else{
                if (typeof this.form.image === 'string'){
                    delete this.form.image
                }
                this.$inertia.post('/news/' + this.article.data.id, this.form)
            }
        },
        onFileChange(e) {
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length)
                return;
            this.form.image = files[0]
            this.imagePreview = URL.createObjectURL(this.form.image);
        },
    }
}
</script>

<style scoped>

</style>
