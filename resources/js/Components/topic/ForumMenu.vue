<script setup>
import Button from "@/Components/forms/Button.vue";
import { computed } from "vue";
import { usePage, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    topics: Object,
    categories: Object,
});

const auth = computed(() => usePage().props.value.auth);
</script>

<template>
    <Link :href="route('post.create')">
        <Button
            v-if="auth.user"
            class="bg-shyk-blue w-full px-12 text-base font-bold normal-case hover:bg-blue-600 hover:shadow-lg"
        >
            Post erstellen
        </Button>
    </Link>
    <div class="mt-4 mb-4">
        <Link
            :href="route('discover')"
            class="group/all flex cursor-pointer flex-row space-x-4"
        >
            <span
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        d="M5.455 15L1 18.5V3a1 1 0 0 1 1-1h15a1 1 0 0 1 1 1v12H5.455zm-.692-2H16V4H3v10.385L4.763 13zM8 17h10.237L20 18.385V8h1a1 1 0 0 1 1 1v13.5L17.545 19H9a1 1 0 0 1-1-1v-1z"
                    />
                </svg>
            </span>
            <span
                class="group-hover/all:font-bold"
                :class="
                    route().current('discover', { topic: '' })
                        ? 'font-bold'
                        : ''
                "
                >Alle Posts</span
            >
        </Link>
        <span
            v-if="auth.user"
            class="group/my flex cursor-pointer flex-row space-x-4"
        >
            <span
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="24"
                    height="24"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        d="M4 22a8 8 0 1 1 16 0H4zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6 6 2.685 6 6-2.685 6-6 6z"
                    />
                </svg>
            </span>
            <span
                class="group-hover/my:font-bold"
                :class="route().current('user.report') ? 'font-bold' : ''"
                >Meine Posts</span
            >
        </span>
    </div>

    <div class="w-full">
        <div class="flex items-center">
            <div class="h-px flex-grow bg-black"></div>
            <span
                class="flex-shrink px-4 text-sm font-light uppercase text-black"
                >Kategorien</span
            >
            <div class="h-px flex-grow bg-black"></div>
        </div>
    </div>

    <div class="mt-2 mb-4">
        <Link
            :href="
                route('discover', {
                    topic: route().params.topic,
                    category: category.slug,
                })
            "
            class="group/all mb-1 flex cursor-pointer flex-row space-x-4"
            v-for="category in props.categories"
            :key="category.id"
        >
            <span v-html="category.symbol"></span>
            <span
                class="group-hover/all:font-bold"
                :class="
                    route().current('discover', { category: category.slug })
                        ? 'font-bold'
                        : ''
                "
                :style="'color:' + category.color + ';'"
                >{{ category.name }}</span
            >
        </Link>
        <Link
            v-if="route().params.category"
            :href="
                route('discover', {
                    topic: route().params.topic,
                    category: null,
                })
            "
            class="group/all mb-1 flex cursor-pointer flex-row space-x-4"
        >
            <span
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="20"
                    height="20"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        fill="#64748B"
                        d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"
                    />
                </svg>
            </span>
            <span class="text-sm text-slate-500 group-hover/all:font-bold"
                >filter lösen</span
            >
        </Link>
    </div>
    <div class="w-full">
        <div class="flex items-center">
            <div class="h-px flex-grow bg-black"></div>
            <span
                class="flex-shrink px-4 text-sm font-light uppercase text-black"
                >Themen</span
            >
            <div class="h-px flex-grow bg-black"></div>
        </div>
    </div>

    <div class="mt-2 mb-4">
        <Link
            :href="
                route('discover', {
                    topic: topic.slug,
                    category: route().params.category,
                })
            "
            class="group/all mb-1 flex cursor-pointer flex-row space-x-4"
            v-for="topic in topics"
            :key="topic.id"
        >
            <span v-html="topic.symbol"></span>
            <span
                class="group-hover/all:font-bold"
                :class="
                    route().current('discover', { topic: topic.slug })
                        ? 'font-bold'
                        : ''
                "
                :style="'color:' + topic.color + ';'"
                >{{ topic.name }}</span
            >
        </Link>
        <Link
            v-if="route().params.topic"
            :href="
                route('discover', {
                    topic: null,
                    category: route().params.category,
                })
            "
            class="group/all mb-1 flex cursor-pointer flex-row space-x-4"
        >
            <span
                ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    width="20"
                    height="20"
                >
                    <path fill="none" d="M0 0h24v24H0z" />
                    <path
                        fill="#64748B"
                        d="M12 10.586l4.95-4.95 1.414 1.414-4.95 4.95 4.95 4.95-1.414 1.414-4.95-4.95-4.95 4.95-1.414-1.414 4.95-4.95-4.95-4.95L7.05 5.636z"
                    />
                </svg>
            </span>
            <span class="text-sm text-slate-500 group-hover/all:font-bold"
                >filter lösen</span
            >
        </Link>
    </div>

    <div class="w-full">
        <div class="h-[2px] flex-grow bg-black"></div>
    </div>
</template>
