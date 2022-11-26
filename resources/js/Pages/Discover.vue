<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "@/Components/topic/Banner.vue";
import ForumMenu from "@/Components/topic/ForumMenu.vue";
import Post from "@/Components/topic/Post.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    topic: Object,
    topics: Object,
    categories: Object,
    posts: Object,
    myposts: Object,
});
</script>

<template>
    <Head title="Entdecke!" />

    <DefaultLayout>
        <Banner :topic="props.topic" />

        <div class="mt-8 grid grid-cols-3 gap-16">
            <div class="col-span-1 h-full justify-self-end">
                <div>
                    <ForumMenu
                        :topics="props.topics"
                        :categories="props.categories"
                    />
                </div>
            </div>
            <div class="col-span-2 mb-8 w-full">
                <Post
                    v-for="post in props.posts.data"
                    :key="post.id"
                    :data="post"
                />
                <Post
                    v-if="route().params.topic === 'my'"
                    v-for="post in props.myposts.data"
                    :key="post.id"
                    :data="post"
                />
                <Pagination class="mt-6" :links="props.posts.links" />
            </div>
        </div>
    </DefaultLayout>
</template>
