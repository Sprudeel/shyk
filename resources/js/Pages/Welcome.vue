<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import NavBar from '@/Components/Navbar.vue'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})
</script>

<template>
    <Head title="Welcome" />

    <NavBar />


    

</template>
