<script setup>
import { computed } from "vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link } from "@inertiajs/inertia-vue3";
const auth = computed(() => usePage().props.value.auth);

const props = defineProps({
    comment: Object,
});

function toDateFormat(date) {
    return moment(String(date)).format("DD. MM YYYY, HH:MM");
}
</script>

<template>
    <div>
        <div class="grid w-full grid-cols-7 grid-rows-1 items-start gap-4 p-2">
            <div class="col-span-1 w-fit">
                <Link
                    :href="
                        route('userprofile.view', {
                            username: props.comment.author.username,
                        })
                    "
                >
                    <span class="relative flex w-fit">
                        <img
                            :src="
                                Inertia.page.props.ziggy.url +
                                '/avatars/' +
                                props.comment.author.avatar
                            "
                            class="h-20 w-20 rounded-full object-cover"
                        />
                        <span
                            v-if="props.comment.author.role.name !== 'User'"
                            class="absolute top-0 right-0 flex h-6 w-6 items-center justify-center rounded-full bg-red-500"
                        >
                            <div v-html="props.comment.author.role.symbol"></div
                        ></span>
                    </span>
                </Link>
            </div>
            <div class="col-span-6 rounded-lg border border-slate-200 p-4">
                <div class="flex flex-col">
                    <div class="flex flex-row items-center gap-4">
                        <span class="text-sm font-semibold">{{
                            props.comment.author.username
                        }}</span>
                        <span class="text-xs">
                            {{ toDateFormat(props.comment.created_at) }}
                        </span>
                        <span
                            class="text-xs"
                            v-if="
                                props.comment.created_at !==
                                props.comment.updated_at
                            "
                        >
                            Bearbeitet
                        </span>
                    </div>
                    <span class="text-sm">{{ props.comment.content }}</span>
                    <span
                        v-if="props.comment.subcomments"
                        class="m-4 text-xs font-semibold uppercase text-slate-400"
                        >antworten</span
                    >
                </div>
            </div>
        </div>
    </div>
</template>
