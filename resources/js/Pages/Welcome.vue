<template>
    <Head title="Home" />

    <NavBar />

    <p>{{ user }}</p>
    <p>{{ laravelVersion }}</p>
    <p>{{ phpVersion }}</p>
</template>

<script setup>
import NavBar from "@/Components/Navbar.vue";
import { computed } from 'vue'
import { Head, Link } from "@inertiajs/inertia-vue3";



const props = defineProps({
    laravelVersion: String,
    phpVersion: String,
    user: Object,
});

</script>
