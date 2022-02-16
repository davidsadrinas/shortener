<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <input v-model="url" required>
                        <button type="submit" @click="sendUrl">Submit URL</button>
                        </br>
                        </br>
                        </br>
                        <a v-if="this.newUrl !== ''" :href="this.newUrl" target="_blank">{{ 'http:://localhost/'+ this.newUrl }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
    export default {
        data() {
            return {
                'url':'',
                'newUrl': '',
            }
        },
        methods: {
            sendUrl(){
                console.log(this.url);
                axios.post('/url', {
                    url: this.url
                }).then((response) => {
                    this.newUrl = response.data
                });
            },
        },
    }
</script>
