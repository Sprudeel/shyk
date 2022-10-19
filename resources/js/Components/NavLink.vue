<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "inline-flex items-center px-6 h-16 text-base  o-md:text-sm border-b-2 border-indigo-400 font-medium leading-5 text-black hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out"
        : "inline-flex items-center px-6 h-16 text-base  o-md:text-sm border-b-2 border-white font-medium leading-5 text-black hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
