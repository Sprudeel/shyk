<script setup>
import Button from "@/Components/forms/Button.vue";
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const auth = computed(() => usePage().props.value.auth);
</script>

<template>
    <Button
        class="bg-shyk-blue ml-8 px-8 text-base font-bold normal-case hover:bg-blue-500 hover:font-bold hover:shadow-lg"
    >
        Post erstellen
    </Button>
    <div class="mt-4 mb-4">
        <a class="group/all flex cursor-pointer flex-row space-x-4">
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
                :class="route().current('discover') ? 'font-bold' : ''"
                >Alle Posts</span
            >
        </a>
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

    <span class="relative">
        <hr class="border-black" />
        <span class="uppercase">Subforen</span>
    </span>
</template>
