<script setup>
import NavBar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import FlashMessages from "@/Components/FlashMessages.vue";
</script>

<template>
    <NavBar />

    <FlashMessages />

    <slot />

    <Footer />
</template>
