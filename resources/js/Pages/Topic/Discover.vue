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

        <div class="mr-8 ml-8">
            <div class="mt-8 gap-8 md:grid md:auto-cols-auto md:grid-flow-col">
                <div
                    class="h-full ph:mx-auto ph:mb-8 ph:text-center md:justify-self-end"
                >
                    <div>
                        <ForumMenu
                            :topics="props.topics"
                            :categories="props.categories"
                        />
                    </div>
                </div>
                <div class="w-full md:col-span-2 md:mb-8">
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
                    <Pagination class="m-6" :links="props.posts.links" />
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
