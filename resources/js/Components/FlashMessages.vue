<script setup>
import { computed, ref } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";
import {
    CheckIcon,
    XMarkIcon,
    InformationCircleIcon,
} from "@heroicons/vue/24/outline";

const flash = computed(() => usePage().props.value.flash);
</script>

<template>
    <span
        v-if="flash.success"
        class="sticky top-24 right-12 float-right flex w-fit animate-flash flex-row rounded-lg bg-green-300 py-4 px-6 text-green-800"
        ><CheckIcon class="mr-4 w-4" /> {{ flash.success }}
    </span>
    <span
        v-if="flash.notification"
        class="sticky top-24 right-12 float-right flex w-fit animate-flash flex-row rounded-lg bg-blue-300 p-4 text-blue-800"
        ><InformationCircleIcon class="mr-4 w-4" /> {{ flash.notification }}
    </span>
    <span
        v-if="flash.error"
        class="sticky top-24 right-12 float-right flex w-fit animate-flash flex-row rounded-lg bg-red-300 p-4 text-red-800"
        ><XMarkIcon class="mr-4 w-4" /> {{ flash.error }}
    </span>
</template>
