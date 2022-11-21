<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Inertia } from "@inertiajs/inertia";
import Banner from "@/Components/topic/Banner.vue";
import ForumMenu from "@/Components/topic/ForumMenu.vue";
import Post from "@/Components/topic/Post.vue";
import moment from "moment";

const props = defineProps({
    data: Object,
});

moment.locale("de-ch");
const joined = moment(String(props.data.created_at)).format("DD. MMM YY");
</script>

<template>
    <div class="mb-8 max-w-3xl bg-white p-4">
        <div class="grid grid-cols-3 grid-rows-3">
            <div class="col-span-2 text-2xl font-bold">
                {{ props.data.title }}
            </div>
            <span
                class="h-full w-2/3 place-self-end self-center border-2 text-center"
                >{{ props.data.topic }}</span
            >

            <span class="row-span-2 flex flex-row items-center space-x-4">
                <img
                    :src="
                        Inertia.page.props.ziggy.url +
                        '/avatars/' +
                        props.data.author.avatar
                    "
                    class="h-16 w-16 rounded-full object-cover"
                />
                <span class="flex flex-col">
                    <span class="font-bold">{{
                        props.data.author.username
                    }}</span>
                    <span class="text-sm text-gray-500">{{ joined }}</span>
                </span>
            </span>
        </div>
    </div>
    {{ props.data }}
</template>
