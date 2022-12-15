<script setup>
import { computed } from "vue";
import moment from "moment";
import { Inertia } from "@inertiajs/inertia";
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, Link } from "@inertiajs/inertia-vue3";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
import reportPostModal from "@/Components/modals/reportPost.vue";
import Label from "@/Components/forms/Label.vue";
import Comments from "@/Components/post/Comments.vue";
import NewComment from "@/Components/post/NewComment.vue";
import Pagination from "@/Components/Pagination.vue";

const auth = computed(() => usePage().props.value.auth);

const props = defineProps({
    post: Object,
    likes: Object,
    liked: Boolean,
    attachements: Object,
    comments: Object,
});

moment.locale("de-ch");
const created = moment(String(props.post.created_at)).format(
    "DD. MM YYYY, HH:MM"
);
const updated = moment(String(props.post.updated_at)).format(
    "DD. MM YYYY, HH:MM"
);

function toDateFormat(date) {
    return moment(String(date)).format("DD. MM YYYY, HH:MM");
}

function convert(value) {
    let sizes = ["Bytes", "KB", "MB", "GB", "TB"];
    if (value == 0) return "0 Byte";
    let i = parseInt(Math.floor(Math.log(value) / Math.log(1024)));
    return Math.round(value / Math.pow(1024, i), 2) + " " + sizes[i];
}
</script>

<template>
    <Head :title="props.post.title" />

    <DefaultLayout>
        <div class="mx-4 mt-8 mb-8 grid-cols-4 grid-rows-1 sm:grid">
            <div class="col-span-3 mr-4">
                <div class="grid-rows-7 grid grid-cols-6 items-center">
                    <div class="">
                        <Link
                            :href="
                                route('userprofile.view', {
                                    username: props.post.author.username,
                                })
                            "
                        >
                            <span
                                class="relative row-span-2 flex flex-row items-center space-x-4 transition-all hover:scale-105"
                            >
                                <img
                                    :src="
                                        Inertia.page.props.ziggy.url +
                                        '/avatars/' +
                                        props.post.author.avatar
                                    "
                                    class="ml-auto h-24 w-24 rounded-full object-cover"
                                />
                                <span
                                    v-if="
                                        props.post.author.role.name !== 'User'
                                    "
                                    class="absolute top-0 right-0 flex h-6 w-6 items-center justify-center rounded-full bg-red-500"
                                >
                                    <div
                                        v-html="props.post.author.role.symbol"
                                    ></div
                                ></span>
                            </span>
                        </Link>
                    </div>
                    <div class="col-span-5">
                        <div
                            class="ml-4 mr-4 grid grid-cols-1 grid-rows-2 items-end gap-2 truncate"
                        >
                            <div class="flex flex-row items-end space-x-8">
                                <Link
                                    :href="
                                        route('userprofile.view', {
                                            username:
                                                props.post.author.username,
                                        })
                                    "
                                >
                                    <span class="font-bold">{{
                                        props.post.author.username
                                    }}</span>
                                </Link>
                                <span class="text-sm">{{ created }}</span>
                                <span class="text-sm" v-if="created !== updated"
                                    >Bearbeitet am {{ updated }}</span
                                >
                            </div>
                            <div class="font-extrabold">
                                <span
                                    v-if="props.post.status == 'private'"
                                    title="Post ist privat!"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24"
                                        width="24"
                                        height="24"
                                        class="mr-4"
                                    >
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path
                                            d="M18 8h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9a1 1 0 0 1 1-1h2V7a6 6 0 1 1 12 0v1zm-7 7.732V18h2v-2.268a2 2 0 1 0-2 0zM16 8V7a4 4 0 1 0-8 0v1h8z"
                                        />
                                    </svg>
                                </span>
                                <span class="flex flex-row">
                                    <span
                                        class="ph:text-base md:text-xl lg:text-2xl"
                                    >
                                        {{ props.post.title }}
                                    </span>
                                    <span
                                        v-if="props.post.verified"
                                        title="Dieser Post wurde verifiziert!"
                                    >
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5"
                                            stroke="currentColor"
                                            class="shyk-blue ml-4 h-8 w-8"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                                            />
                                        </svg>
                                    </span>
                                </span>
                            </div>
                            <hr />
                        </div>
                    </div>
                    <span></span>
                    <div class="col-span-5 row-span-5 ml-4 mr-8">
                        <div
                            v-html="props.post.content"
                            class="o-ph:text-sm"
                        ></div>
                        <div class="mt-8 w-full p-2 o-ph:text-xs">
                            <Label for="title" value="Anhänge" class="mb-1" />
                            <a
                                :href="file.url"
                                target="_blank"
                                v-for="file in props.attachements"
                                class="mb-1 flex flex-row items-center space-x-4 hover:font-bold"
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
                                            d="M9 2.003V2h10.998C20.55 2 21 2.455 21 2.992v18.016a.993.993 0 0 1-.993.992H3.993A1 1 0 0 1 3 20.993V8l6-5.997zM5.83 8H9V4.83L5.83 8zM11 4v5a1 1 0 0 1-1 1H5v10h14V4h-8z"
                                        />
                                    </svg>
                                </span>
                                <span>{{ file.name }}</span>
                                <span>{{ convert(file.size) }}</span>
                            </a>
                        </div>
                        <div>
                            <div class="mt-8 w-full p-2 o-ph:text-xs">
                                <Label
                                    for="title"
                                    value="Kommentare"
                                    class="mb-1"
                                />
                                <NewComment
                                    v-if="auth.permissions.comment_create"
                                />
                                <Comments
                                    v-for="comment in props.comments.data"
                                    :key="comment.id"
                                    :comment="comment"
                                />

                                <Pagination
                                    class="m-6"
                                    :links="props.comments.links"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-12 ml-2 h-fit ph:flex ph:justify-around sm:flex-col">
                <span class="mb-4 flex flex-row" v-if="auth.user">
                    <Link
                        v-if="
                            auth.permissions.userprofile_edit_self &&
                            auth.user.username == props.post.author.username
                        "
                        :href="`/post/edit/${props.post.slug}`"
                        title="Post bearbeiten"
                    >
                        <PencilSquareIcon
                            class="shyk-blue mr-2 h-8 w-8 rounded-lg p-1 hover:bg-blue-500 hover:text-white"
                        />
                    </Link>

                    <Link
                        v-else-if="
                            auth.permissions.userprofile_edit_all &&
                            auth.user.username != props.post.author.username
                        "
                        :href="`/post/edit/${props.post.slug}`"
                        title="Post bearbeiten"
                    >
                        <PencilSquareIcon
                            class="mr-2 h-8 w-8 rounded-lg p-1 text-yellow-300 hover:bg-yellow-300 hover:text-white"
                        />
                    </Link>

                    <Link
                        v-if="
                            auth.permissions.post_delete_all ||
                            (auth.permissions.post_delete_self &&
                                auth.user.username ==
                                    props.post.author.username)
                        "
                        :href="`/post/delete/${props.post.slug}`"
                        title="Post löschen"
                        method="post"
                        as="button"
                    >
                        <TrashIcon
                            class="mr-2 h-8 w-8 rounded-lg p-1 text-red-500 hover:bg-red-500 hover:text-white"
                        />
                    </Link>

                    <reportPostModal
                        v-if="props.post.author.id != auth.user.id"
                        :data="props.post"
                    />
                </span>
                <Link
                    :href="route('post.like', { slug: props.post.slug })"
                    method="post"
                    as="button"
                >
                    <span
                        class="mb-4 flex w-fit cursor-pointer flex-row space-x-2 rounded-lg py-2"
                        v-if="
                            !liked && auth.user && props.post.status == 'public'
                        "
                    >
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
                        <span>{{ props.likes.length }}</span>
                    </span>
                    <span
                        class="mb-4 flex w-fit cursor-pointer flex-row space-x-2 rounded-lg py-2"
                        v-if="
                            liked && auth.user && props.post.status == 'public'
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            width="24"
                            height="24"
                        >
                            <path fill="none" d="M0 0H24V24H0z" />
                            <path
                                fill="#f47379"
                                d="M12.001 4.529c2.349-2.109 5.979-2.039 8.242.228 2.262 2.268 2.34 5.88.236 8.236l-8.48 8.492-8.478-8.492c-2.104-2.356-2.025-5.974.236-8.236 2.265-2.264 5.888-2.34 8.244-.228z"
                            />
                        </svg>
                        <span>{{ props.likes.length }}</span>
                    </span>
                </Link>

                <Link
                    :href="route('post.verify', { slug: props.post.slug })"
                    method="post"
                    as="button"
                >
                    <span
                        class="flex w-fit cursor-pointer flex-row space-x-2 rounded-lg bg-green-200 py-2 px-4 hover:bg-green-300"
                        v-if="
                            auth.permissions.post_verify && !props.post.verified
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 text-green-700"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                            />
                        </svg>

                        <span class="text-green-700">Verifizieren</span>
                    </span>
                    <span
                        class="flex w-fit cursor-pointer flex-row space-x-2 rounded-lg bg-red-200 py-2 px-4 hover:bg-red-300"
                        v-if="
                            auth.permissions.post_verify && props.post.verified
                        "
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="h-6 w-6 text-red-700"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"
                            />
                        </svg>

                        <span class="text-red-700">Entverifizieren</span>
                    </span>
                </Link>
            </div>
        </div>
    </DefaultLayout>
</template>
