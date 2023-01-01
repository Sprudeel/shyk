<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, Link } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
import { PencilSquareIcon } from "@heroicons/vue/24/outline";
import { Inertia } from "@inertiajs/inertia";
import reportUserModal from "@/Components/modals/reportUser.vue";

const props = defineProps({
    User: Object,
});

const auth = computed(() => usePage().props.value.auth);

function toDateFormat(date) {
    var d = new Date(date);
    return new Intl.DateTimeFormat("de-ch", {
        dateStyle: "long",
    }).format(d);
}

const joined = toDateFormat(props.User.created_at);

const NavClasses = computed(() =>
    props.active
        ? "inline-flex items-center px-6 h-16 text-base  o-md:text-sm border-b-2 border-indigo-400 font-medium leading-5 text-black hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-6 h-16 text-base  o-md:text-sm border-b-2 border-white font-medium leading-5 text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
);

let NavSelector = ref("posts");

function NavSelectorChange(click) {
    return (this.NavSelector = click);
}
</script>

<template>
    <Head :title="User.username + 's Profil'" />

    <DefaultLayout>
        <div class="relative z-0 mx-auto mb-8 h-full w-5/6">
            <span
                class="absolute right-12 top-8 m-6 flex flex-row"
                v-if="auth.user"
            >
                <Link
                    v-if="
                        auth.permissions.userprofile_edit_self &&
                        auth.user.username == User.username
                    "
                    :href="`/user/edit/${User.username}`"
                    title="Mein Profil bearbeiten"
                >
                    <PencilSquareIcon
                        class="shyk-blue mr-2 h-8 w-8 rounded-lg p-1 hover:bg-blue-500 hover:text-white"
                    />
                </Link>

                <Link
                    v-else-if="
                        auth.permissions.userprofile_edit_all &&
                        auth.user.username != User.username
                    "
                    :href="`/user/edit/${User.username}`"
                    title="Nutzer bearbeiten"
                >
                    <PencilSquareIcon
                        class="mr-2 h-8 w-8 rounded-lg p-1 text-yellow-300 hover:bg-yellow-300 hover:text-white"
                    />
                </Link>

                <reportUserModal v-if="User.id != auth.user.id" :user="User" />
            </span>

            <div
                class="flex ph:flex-col md:flex-row md:items-center md:divide-x"
            >
                <div class="mt-2 mb-8 basis-1/3">
                    <img
                        :src="
                            Inertia.page.props.ziggy.url +
                            '/avatars/' +
                            User.avatar
                        "
                        class="mx-auto mt-2 mb-8 rounded-full object-cover ph:h-80 md:h-72 md:w-72"
                    />
                    <div class="ml-8">
                        <span class="flex items-center">
                            <span class="text-2xl font-bold">{{
                                User.username
                            }}</span>
                            <span
                                class="ml-4 rounded-lg p-1 text-sm font-bold uppercase tracking-wider text-white"
                                v-if="User.role.name != 'User'"
                                :style="
                                    'background-color: ' + User.role.color + ';'
                                "
                                >{{ User.role.name }}</span
                            >
                        </span>
                        <span class="text-lg">{{ User.name }}</span>
                        <br />
                        <span class="text-sm"
                            >Beitritt
                            <span class="font-semibold">{{
                                joined
                            }}</span></span
                        >
                    </div>
                </div>

                <div class="basis-2/3 p-8">
                    <h2 class="text-lg font-bold">Über mich</h2>
                    <span v-html="User.about"></span>
                    <h2 class="mt-12 text-lg font-bold">Erfahrung</h2>
                    <span class="italic text-violet-500">
                        Hier ensteht ein Nutzer Erfahrungs System!</span
                    >
                </div>
            </div>
            <!-- <div class="mx-auto w-4/6">
                <div class="flex items-center justify-evenly">
                    <span
                        :class="NavClasses"
                        class="cursor-pointer"
                        @click="NavSelectorChange('posts')"
                        >Beiträge</span
                    >
                    <span
                        :class="NavClasses"
                        class="cursor-pointer"
                        @click="NavSelectorChange('comments')"
                        >Likes</span
                    >
                    <span
                        :class="NavClasses"
                        class="cursor-pointer"
                        @click="NavSelectorChange('likes')"
                        >Kommentare</span
                    >
                </div>

                <div
                    id="nav__posts"
                    v-show="NavSelector == 'posts'"
                    class="text-center"
                >
                    POSTS!
                </div>
                <div
                    id="nav__likes"
                    v-if="NavSelector == 'likes'"
                    class="text-center"
                >
                    likes!
                </div>
                <div
                    id="nav__comments"
                    v-if="NavSelector == 'comments'"
                    class="text-center"
                >
                    comments!
                </div>
            </div> -->
        </div>
    </DefaultLayout>
</template>
