<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span> Posts</span>
                        <span class="cursor-pointer"
                              @click="newPost=!newPost"> {{ newPost ? 'Cancel ' : '' }}Add Post</span>
                        <span class="cursor-pointer" @click="getPosts()">Refresh </span>
                    </div>

                    <div class="card-body">
                        <form v-if="newPost" class="row" @submit.prevent="createPost()">
                            <div class=" col-12 from-group">
                                <label for="title" class="w-100">
                                    Title
                                    <input v-model="selectedPost.title" id="title" class="form-control" type="text">
                                </label>
                                <label for="body" class="w-100">
                                    Body
                                    <textarea v-model="selectedPost.body" id="body" class="form-control"
                                              type="text"></textarea>
                                </label>
                            </div>
                            <button class="offset-10 col-2 btn btn-primary" type="submit"> Post</button>
                        </form>
                    </div>

                    <div class="border border-dark rounded p-3 m-3" v-for="post in posts">
                        <div class="d-block">
                            <h1 class="w-100 text-primary text-center">{{ post.title }}</h1>
                        </div>
                        <div class="d-block bg-info ">
                            <p class="w-100 p-4 text-white text-left font-weight-bolder">{{ post.body }}</p>
                        </div>
                        <div class="d-block row m-2">
                            <button @click="selectedPost=post; editPost=true" class="btn btn-secondary offset-7 col-2">
                                Edit
                            </button>
                            <button @click="deletePost(post)" class="btn btn-danger col-2">Delete</button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {

    name: "PostIndex",
    data() {
        return {
            posts: [],
            selectedPost: {
                id: null,
                title: '',
                body: '',
            },
            editPost: false,
            newPost: false,
        }
    },

    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            let url = '/post/getPosts'
            axios.get(url)
                .then(response => {
                    this.posts = response.data;
                })
                .catch(err => {

                }).finally(() => {

            })
        },
        createPost() {
            let url = '/post';
            axios.post(url, this.selectedPost)
                .then((response) => {
                    this.getPosts();
                    this.resetForm();
                })
                .catch(err => {

                }).finally(() => {

            })
        },
        deletePost(post) {
            let url = '/post/' + post.id;
            axios.delete(url)
                .then(() => {
                    this.getPosts();
                })
                .catch(err => {

                })
                .finally(() => {
                    this.resetForm();
                })
        },
        togglePostArea($var) {
            if ($var == true) {
                $var = false
            } else
                $var = true


        },
        resetForm() {
            this.selectedPost = {
                id: null,
                title: '',
                body: '',
            }
            this.editPost = false
            this.newPost = true
        }

    }
}
</script>


<style scoped>
.cursor-pointer {
    cursor: pointer;
}
</style>
