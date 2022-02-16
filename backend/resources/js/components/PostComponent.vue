<template>

    <div class="mb-5">
        <h3>{{ post.attributes.title }}</h3>
        <p>{{ post.attributes.content }}</p>
    </div>

</template>

<script>
    export default {
        props: [
            "post"
        ]
    }
</script>
