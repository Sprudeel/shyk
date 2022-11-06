<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, Link } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
import LogoMeditating from "@/Components/svg/logo/Meditating.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";
import moment from "moment";

const props = defineProps({
    User: Object,
});

const auth = computed(() => usePage().props.value.auth);

moment.locale("de-ch");
const joined = moment(String(props.User.created_at)).format("DD. MMM YY");

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
        <div class="relative mx-auto mt-8 mb-8 h-full w-5/6 shadow-lg">
            <span class="absolute right-0 m-6 flex flex-row">
                <Link
                    v-if="
                        auth.permissions.userprofile_edit_self &&
                        auth.user.username == User.username
                    "
                    :href="`/user/edit/${User.username}`"
                    title="Mein Profil bearbeiten"
                >
                    <PencilSquareIcon class="shyk-blue mr-2 h-5 w-5" />
                </Link>

                <Link
                    v-if="auth.permissions.userprofile_edit_all"
                    :href="`/user/edit/${User.username}`"
                    title="Nutzer bearbeiten"
                >
                    <PencilSquareIcon class="mr-2 h-5 w-5 text-yellow-300" />
                </Link>
            </span>
            <div class="flex items-center divide-x">
                <div class="mt-8 mb-8 basis-1/3">
                    <LogoMeditating
                        class="mx-auto mb-8 h-56 w-56 rounded-lg p-4"
                    />
                    <div class="ml-10">
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
                    <span class=""> {{ User.about }}</span>
                    <h2 class="mt-12 text-lg font-bold">Erfahrung</h2>
                    <span class="italic text-violet-500">
                        Hier ensteht ein Nutzer Erfahrungs System!</span
                    >
                </div>
            </div>
            <div class="mx-auto w-4/6">
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
            </div>
        </div>
    </DefaultLayout>
</template>
