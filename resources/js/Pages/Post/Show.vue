<script setup>
import { computed } from "vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";

const props = defineProps({
    post: Object,
});

moment.locale("de-ch");
const created = moment(String(props.post.created_at)).format("DD. MMM YY");
const updated = moment(String(props.post.updated_at)).format("DD. MMM YY");

const auth = computed(() => usePage().props.value.auth);
</script>

<template>
    <Head :title="props.post.title" />

    <DefaultLayout>
        <div class="mx-48 mt-8 mb-8 grid grid-cols-4 grid-rows-1">
            <div class="col-span-3">
                <div class="grid-rows-7 grid grid-cols-6 items-center">
                    <div class="">
                        <span
                            class="relative row-span-2 flex flex-row items-center space-x-4"
                        >
                            <img
                                :src="
                                    Inertia.page.props.ziggy.url +
                                    '/avatars/' +
                                    props.post.author.avatar
                                "
                                class="ml-auto h-32 w-32 rounded-full object-cover"
                            />
                            <span
                                v-if="props.post.author.role.name !== 'User'"
                                class="absolute top-2 right-2 flex h-6 w-6 items-center justify-center rounded-full bg-red-500"
                            >
                                <span v-html="props.post.author.role.symbol">
                                </span
                            ></span>
                        </span>
                    </div>
                    <div class="col-span-5">
                        <div
                            class="ml-4 grid grid-cols-1 grid-rows-3 items-end"
                        >
                            <div class="flex flex-row space-x-8">
                                <span class="font-bold">{{
                                    props.post.author.username
                                }}</span>
                                <span>{{ created }}</span>
                                <span>Bearbeitet am {{ updated }}</span>
                            </div>
                            <div class="row-span-2 text-3xl font-extrabold">
                                {{ props.post.title }}
                            </div>
                            <hr />
                        </div>
                    </div>
                    <span></span>
                    <div class="col-span-5 row-span-5">
                        {{ props.post.content }}
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
