<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "@/Components/topic/Banner.vue";
import Post from "@/Components/topic/Post.vue";
import Pagination from "@/Components/Pagination.vue";
import Searchbar from "@/Components/forms/Searchbar.vue";

const props = defineProps({
    search: String,
    posts: Object,
});
</script>

<template>
    <Head title="Suche" />

    <DefaultLayout>
        <Banner topic="search" :search="props.search" />

        <div class="mx-4 mt-8 flex flex-col items-center">
            <div class="mb-4">
                <!-- Search Bar -->
                <Searchbar class="" />
            </div>
            <div>
                <Post
                    v-for="post in props.posts.data"
                    :key="post.id"
                    :data="post"
                />
                <Pagination class="m-6" :links="props.posts.links" />
            </div>
            <div
                v-if="props.posts.total == 0"
                class="flex flex-col items-center gap-4 text-xl text-gray-500"
            >
                <span>¯\_( ❛ ͜ʖ ❛ )_/¯</span>
                <span>Leider wurde nichts gefunden...</span>
            </div>
        </div>
    </DefaultLayout>
</template>
