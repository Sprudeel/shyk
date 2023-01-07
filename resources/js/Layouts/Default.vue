<script setup>
import NavBar from "@/Components/Navbar.vue";
import Footer from "@/Components/Footer.vue";
import FlashMessages from "@/Components/FlashMessages.vue";
</script>

<template>
    <NavBar />

    <FlashMessages />

    <div class="min-h-screen">
        <slot />
    </div>

    <Footer />
</template>
