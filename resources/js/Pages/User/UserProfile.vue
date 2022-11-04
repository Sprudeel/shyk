<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import LogoMeditating from "@/Components/svg/logo/Meditating.vue";
import moment from "moment";

const props = defineProps({
    User: Object,
});

const user = computed(() => usePage().props.value.auth.user);
const role = computed(() => usePage().props.value.auth.role);
const permissions = computed(() => usePage().props.value.auth.permissions);

moment.locale("de-ch");
const joined = moment(String(props.User.created_at)).format("DD. MMM YY");
</script>

<template>
    <Head :title="User.username + 's Profil'" />

    <DefaultLayout>
        <div class="mx-auto mt-8 mb-8 h-full w-3/4">
            <div class="flex items-center divide-x shadow-lg">
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
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
