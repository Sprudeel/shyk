<script setup>
import Logo from "@/Components/svg/logo/Clean.vue";
import NavLink from "@/Components/NavLink.vue";
import Searchbar from "@/Components/forms/Searchbar.vue";
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.auth.user);
</script>

<template>
    <!-- Navbar -->
    <nav
        class="flex h-16 w-full items-center justify-center bg-white shadow-md"
    >
        <!-- Container for Logo -->
        <Link
            :href="route('home')"
            class="mr-16 flex items-center justify-center"
        >
            <!-- Logo -->
            <Logo class="h-12 w-12" />

            <!-- Text -->
            <p class="text-2xl font-bold">shyk</p>
        </Link>

        <!-- Container for Link Elements -->
        <div class="flex items-center justify-center">
            <NavLink
                :href="route('dashboard')"
                :active="route().current('dashboard')"
                >Entdecken!</NavLink
            >
            <NavLink :href="route('login')" :active="route().current('login')"
                >Hilfe</NavLink
            >
            <NavLink :href="route('login')" :active="route().current('login')"
                >FAQ</NavLink
            >
        </div>

        <!-- Search Bar -->
        <Searchbar class="ml-32" />

        <!-- Login Logout -->
        <Link v-if="user" :href="route('logout')" method="post" class="ml-8">
            Hallo, {{ user.name }}!
        </Link>
        <div v-else class="ml-8">
            <Link
                :href="route('login')"
                class="text-sm text-gray-700 dark:text-gray-500"
                >Anmelden</Link
            >

            <Link class="ml-4 text-sm text-gray-700 dark:text-gray-500"
                >Registrieren</Link
            >
        </div>
    </nav>
</template>
