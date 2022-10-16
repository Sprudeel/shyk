<template>
    <Head title="Home" />

    <DefaultLayout />
</template>

<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { computed } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    laravelVersion: String,
    phpVersion: String,
    user: Object,
});
</script>
