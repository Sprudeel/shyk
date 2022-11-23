<script setup>
import { computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import moment from "moment";
import { usePage, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    data: Object,
});

moment.locale("de-ch");
const joined = moment(String(props.data.created_at)).format("DD. MMM YY");

const auth = computed(() => usePage().props.value.auth);
</script>

<template>
    <div
        class="mb-8 max-w-3xl cursor-pointer rounded-lg border border-slate-300 bg-white p-4 shadow-lg transition-all hover:scale-105"
    >
        <Link :href="route('post.show', { slug: props.data.slug })">
            <div class="grid grid-cols-3 grid-rows-3">
                <div
                    class="col-span-2 self-center text-xl font-bold tracking-wide"
                >
                    {{ props.data.title }}
                </div>
                <span
                    :style="
                        'border-color: ' +
                        props.data.topic.color +
                        '; color: ' +
                        props.data.topic.color +
                        ';'
                    "
                    class="w-2/3 place-self-end self-center rounded-lg border-2 p-1 text-center font-semibold"
                    >{{ props.data.topic.name }}</span
                >

                <span
                    class="relative row-span-2 flex flex-row items-center space-x-4"
                >
                    <img
                        :src="
                            Inertia.page.props.ziggy.url +
                            '/avatars/' +
                            props.data.author.avatar
                        "
                        class="h-12 w-12 rounded-full object-cover"
                    />
                    <span
                        v-if="props.data.author.role.name !== 'User'"
                        class="absolute top-2 left-4 flex h-6 w-6 items-center justify-center rounded-full bg-red-500"
                    >
                        <span v-html="props.data.author.role.symbol"> </span
                    ></span>
                    <span class="flex flex-col">
                        <span class="font-bold"
                            >{{ props.data.author.username }}
                            <span
                                v-if="
                                    auth.user &&
                                    props.data.author.username ==
                                        auth.user.username
                                "
                                class="text-sm font-normal"
                            >
                                (du)</span
                            >
                            <span></span>
                        </span>
                        <span class="text-sm text-gray-500">{{ joined }}</span>
                    </span>
                </span>
                <div class="row-span-2"></div>
                <div class="mt-2">
                    <span
                        :style="
                            'border-color: ' +
                            props.data.category.color +
                            '; background-color: ' +
                            props.data.category.color +
                            ';'
                        "
                        class="float-right rounded-lg border-2 px-4 text-center text-sm font-semibold text-white"
                    >
                        {{ props.data.category.name }}
                    </span>
                </div>
                <div class="self-center">
                    <span class="flex flex-row justify-evenly">
                        <span class="flex flex-row">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                            >
                                <path fill="none" d="M0 0H24V24H0z" />
                                <path
                                    d="M12.001 4.529c2.349-2.109 5.979-2.039 8.242.228 2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236 2.265-2.264 5.888-2.34 8.244-.228zm6.826 1.641c-1.5-1.502-3.92-1.563-5.49-.153l-1.335 1.198-1.336-1.197c-1.575-1.412-3.99-1.35-5.494.154-1.49 1.49-1.565 3.875-.192 5.451L12 18.654l7.02-7.03c1.374-1.577 1.299-3.959-.193-5.454z"
                                />
                            </svg>
                            <span class="ml-4">{{
                                props.data.likes.length
                            }}</span>
                        </span>
                        <span class="flex flex-row">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                            >
                                <path fill="none" d="M0 0h24v24H0z" />
                                <path
                                    d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zm-.692-2H20V5H4v13.385L5.763 17zM11 10h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2z"
                                />
                            </svg>
                            <span class="ml-4">X</span>
                        </span>
                    </span>
                </div>
            </div>
        </Link>
    </div>
</template>
