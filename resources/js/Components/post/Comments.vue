<script setup>
import { computed } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { usePage, Link, useForm } from "@inertiajs/inertia-vue3";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
import { ref } from "vue";
import Subcomment from "@/Components/post/Subcomments.vue";
import NewSubComment from "@/Components/post/NewSubComment.vue";

import Button from "@/Components/forms/Button.vue";
import InputError from "@/Components/forms/InputError.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";

const auth = computed(() => usePage().props.value.auth);

const props = defineProps({
    comment: Object,
});

let editing = ref(false);
let subcommentslice = ref(3);
let newSubComment = ref(false);

const form = useForm({
    id: props.comment.id,
    content: props.comment.content,
});

function toDateFormat(date) {
    var d = new Date(date);
    return new Intl.DateTimeFormat("de-ch", {
        dateStyle: "medium",
        timeStyle: "short",
    }).format(d);
}

function handleContent(s) {
    form.content = s;
}

const submit = () => {
    form.post(route("comment.update"), {
        preserveScroll: true,
        onSuccess: () => {
            editing.value = false;
        },
    });
};
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
                    <span class="relative flex w-full">
                        <img
                            :src="
                                Inertia.page.props.ziggy.url +
                                '/avatars/' +
                                props.comment.author.avatar
                            "
                            class="h-full max-h-20 w-full rounded-full object-cover"
                        />
                        <span
                            v-if="props.comment.author.role.name !== 'User'"
                            :style="
                                'background-color: ' +
                                props.comment.author.role.color +
                                ';'
                            "
                            class="absolute top-0 right-0 flex h-auto w-auto items-center justify-center rounded-full p-1 ph:hidden sm:block"
                        >
                            <div v-html="props.comment.author.role.symbol"></div
                        ></span>
                    </span>
                </Link>
            </div>
            <div
                class="col-span-6 w-full rounded-lg border border-slate-200 p-4"
            >
                <div class="flex flex-col">
                    <div class="flex flex-row items-center gap-4">
                        <span class="text-sm font-semibold o-ph:text-xs">{{
                            props.comment.author.username
                        }}</span>
                        <span class="text-2xs">
                            {{ toDateFormat(props.comment.created_at) }}
                        </span>
                        <span
                            class="text-2xs"
                            v-if="
                                props.comment.created_at !==
                                props.comment.updated_at
                            "
                        >
                            Bearbeitet
                        </span>
                    </div>
                    <span
                        v-if="!editing"
                        class="text-sm"
                        v-html="props.comment.content"
                    ></span>
                    <span v-if="editing">
                        <form @submit.prevent="submit">
                            <div class="mt-8 mb-2">
                                <TipTap
                                    @content="handleContent"
                                    :content="form.content"
                                    :maxChar="256"
                                    v-model="form.content"
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.content"
                                />
                            </div>

                            <Button
                                class="bg-shyk-blue float-right ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                                :class="{
                                    'opacity-25': form.processing,
                                }"
                                :disabled="form.processing"
                            >
                                Bearbeiten
                            </Button>
                        </form>
                    </span>
                    <span
                        v-if="auth.user"
                        class="mt-2 flex flex-row text-xs font-semibold uppercase text-slate-400"
                    >
                        <span
                            v-if="
                                auth.permissions.comment_update_self &&
                                auth.user.username ==
                                    props.comment.author.username
                            "
                            title="Kommentar bearbeiten"
                            @click="editing = true"
                        >
                            <PencilSquareIcon
                                class="shyk-blue mr-2 h-6 w-6 rounded-lg p-1 hover:bg-blue-500 hover:text-white"
                            />
                        </span>

                        <span
                            v-else-if="
                                auth.permissions.comment_update_all &&
                                auth.user.username !=
                                    props.comment.author.username
                            "
                            title="Kommentar bearbeiten"
                            @click="editing = true"
                        >
                            <PencilSquareIcon
                                class="mr-2 h-6 w-6 rounded-lg p-1 text-yellow-300 hover:bg-yellow-300 hover:text-white"
                            />
                        </span>

                        <Link
                            v-if="
                                auth.permissions.comment_delete_all ||
                                (auth.permissions.comment_delete_self &&
                                    auth.user.username ==
                                        props.comment.author.username)
                            "
                            :href="`/comment/delete/${props.comment.id}`"
                            title="Kommentar löschen"
                            method="post"
                            as="button"
                            preserve-scroll
                        >
                            <TrashIcon
                                class="mr-2 h-6 w-6 rounded-lg p-1 text-red-500 hover:bg-red-500 hover:text-white"
                            />
                        </Link>
                    </span>
                </div>
                <div v-if="props.comment.subcomments">
                    <Subcomment
                        v-for="subcomment in props.comment.subcomments.slice(
                            0,
                            subcommentslice
                        )"
                        :subcomment="subcomment"
                    />
                </div>

                <div class="inline-flex gap-4">
                    <div
                        v-if="
                            props.comment.subcomments.length > 3 &&
                            subcommentslice == 3
                        "
                        class="cursor-pointer p-1 text-xs text-slate-500 hover:underline"
                        @click="
                            subcommentslice = props.comment.subcomments.length
                        "
                    >
                        mehr anzeigen
                    </div>
                    <div
                        v-if="
                            subcommentslice ==
                                props.comment.subcomments.length &&
                            subcommentslice > 3
                        "
                        class="cursor-pointer p-1 text-xs text-slate-600 hover:underline"
                        @click="subcommentslice = 3"
                    >
                        weniger anzeigen
                    </div>
                    <div
                        v-if="auth.permissions.comment_create"
                        class="cursor-pointer p-1 text-xs text-slate-600 hover:underline"
                        @click="newSubComment = !newSubComment"
                    >
                        antworten
                    </div>
                </div>
                <div>
                    <NewSubComment
                        v-if="newSubComment"
                        :parent_id="props.comment.id"
                    />
                </div>
            </div>
        </div>
    </div>
</template>
