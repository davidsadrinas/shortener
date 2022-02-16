<template>

    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">Blog</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/">Home</a>
            </nav>
            <a class="btn btn-outline-primary" href="/admin">Admin</a>
        </div>

        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4 mb-5">Lastest posts!</h1>
            <div class="row">
                <div class="col-sm-12">
                    <div v-show="thereAreNoPosts()">
                        <p>There are no posts yet. Come back later!</p>
                    </div>
                    <div class="row justify-content-center">

                    </div>
<!--                    <post
                        v-for="post in posts"
                        v-bind:key="post.id"
                        v-bind:post="post"
                    ></post>-->
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {

        data() {
            return  {
                posts: [],
                fetchedPosts: false
            }
        },

        methods: {
            thereAreNoPosts() {
                return this.posts.length === 0 && this.fetchedPosts === true;
            },

            isLoading() {
                return this.fetchedPosts === false;
            }
        },

        mounted() {
            axios.get('/api/posts').then(response => {
                this.posts = response.data.data;
                this.fetchedPosts = true;
            });
        }

    }
</script>
