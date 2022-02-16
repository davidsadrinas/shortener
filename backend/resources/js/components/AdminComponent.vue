<template>

    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
            <h5 class="my-0 mr-md-auto font-weight-normal">Blog</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <a class="p-2 text-dark" href="/">Home</a>
            </nav>
            <button v-show="isLoggedIn()" v-on:click="logout()">Logout</button>
        </div>

        <div v-show="!isLoggedIn()" class="row justify-content-center">
            <form v-on:submit.prevent="login()">
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email</label>
                <input v-model="email" type="email" id="inputEmail" class="mb-1 form-control" placeholder="Email" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input v-model="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <button id="loginSubmit" class="btn btn-lg btn-primary btn-block mt-3" type="submit">Login</button>
            </form>
        </div>

        <div v-show="view === 'list'" class="px-3 py-3 pt-md-5 pb-md-4 mx-auto">
            <h1 class="display-4 mb-5 text-center">Blog admin</h1>

            <button v-on:click="edit({})" class="mb-3 mt-3">New post</button>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <tr v-for="post in posts">
                    <td>{{ post.id }}</td>
                    <td>{{ post.attributes.title }}</td>
                    <td>
                        <button v-on:click="edit(post)" class="editPost">Edit</button>
                        <button v-on:click="deletePost(post.id)" class="deletePost">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div v-show="view === 'edit'" class="col-md-8 order-md-1">
            <h3 class="mb-3">Post</h3>
            <button class="mb-4" v-on:click="goBackToList()">Back</button>
            <form v-on:submit.prevent="submitPost()">
                <div v-show="typeof currentPost.id != 'undefined'" class="mb-3">
                    <label for="postId">id</label>
                    <input
                            v-model="currentPost.id"
                            type="postId" class="form-control" id="postId" disabled>
                </div>
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input
                            v-model="currentPost.title"
                            type="text" class="form-control" id="title" required>
                </div>
                <div class="mb-3">
                    <label for="content">Content</label>
                    <input
                            v-model="currentPost.content"
                            type="text" class="form-control" id="content" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

</template>

<script>

    const VIEWS = {
        "login": "login",
        "list": "list",
        "edit": "edit"
    };

    export default {

        data() {
            return  {
                "view": this.getDefaultView(),
                "token": this.getToken(),
                "email": "",
                "password": "",
                "posts": [],
                "currentPost": {}
            }
        },

        methods: {

            setToken() {
                axios.defaults.headers.common['Authorization'] = "Bearer " + this.getToken();
            },

            getDefaultView() {
                if (this.isLoggedIn()) {
                    return VIEWS.list;
                }

                return VIEWS.login;
            },

            getToken() {
                return sessionStorage.getItem('token');
            },

            isLoggedIn() {
                return this.getToken();
            },

            logout() {
                this.setToken();
                axios.get('/api/auth/logout');
                sessionStorage.setItem('token', '');
                this.view = VIEWS.login;
                this.email = "";
                this.password = "";
            },

            login() {
                axios.post('/api/auth/login', {
                    "email": this.email,
                    "password": this.password
                }).then(response => {
                    sessionStorage.setItem('token', response.data.data.access_token);
                    this.view = VIEWS.list;
                }).catch(() => {
                    this.email = "";
                    this.password = "";
                });
            },

            getPosts() {
                axios.get('/api/posts').then(response => {
                    this.posts = response.data.data;
                });
            },

            deletePost(postId) {
                this.setToken();
                axios.delete('/api/posts/' + postId)
                    .then(() => {
                        this.posts = this.posts.filter(post => {
                            return post.id !== postId
                        });
                    });
            },

            edit(post) {
                this.setToken();
                this.view = VIEWS.edit;

                if (typeof post.id != 'undefined') {
                    this.currentPost = {
                        "id": post.id,
                        "title": post.attributes.title,
                        "content": post.attributes.content
                    };
                    return;
                }

                this.currentPost = {
                    "title": "",
                    "content": ""
                };
            },

            goBackToList() {
                this.view = VIEWS.list;
            },

            submitPost() {
                this.setToken();
                const postData = {
                    "title": this.currentPost.title,
                    "content": this.currentPost.content
                };

                if (typeof this.currentPost.id !== 'undefined') {
                    axios.put('/api/posts/' + this.currentPost.id, postData)
                        .then(() => {
                            for (let i = 0; i<this.posts.length; i++) {
                                if (this.posts[i].id === this.currentPost.id) {
                                    this.posts[i].attributes.title = this.currentPost.title;
                                    this.posts[i].attributes.content = this.currentPost.content;
                                }
                            }
                            this.goBackToList();
                        });
                    return;
                }

                axios.post('/api/posts', postData)
                    .then((response) => {
                        this.posts.push(response.data.data);
                        this.goBackToList();
                    });
            }
        },

        mounted() {
            this.getPosts();
        }

    }

</script>
