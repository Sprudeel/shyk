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
        class="absolute top-24 right-12 flex animate-flash flex-row rounded-lg bg-green-200 p-4 text-green-800"
        ><CheckIcon class="mr-4 w-4" /> {{ flash.success }}
    </span>
    <span
        v-if="flash.notification"
        class="absolute top-24 right-12 flex animate-flash flex-row rounded-lg bg-blue-200 p-4 text-blue-800"
        ><InformationCircleIcon class="mr-4 w-4" /> {{ flash.notification }}
    </span>
    <span
        v-if="flash.error"
        class="absolute top-24 right-12 flex animate-flash flex-row rounded-lg bg-red-200 p-4 text-red-800"
        ><XMarkIcon class="mr-4 w-4" /> {{ flash.error }}
    </span>
</template>
