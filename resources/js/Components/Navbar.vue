<template>
    <!-- Navbar -->
    <nav
        class="flex h-16 w-full items-center justify-center bg-white shadow-md"
    >
        <!-- Container for Logo -->
        <Link
            :href="route('home')"
            class="flex items-center justify-center ph:mr-2 lg:mr-8"
        >
            <!-- Logo -->
            <Logo class="h-12 w-12 o-ph:h-8 o-md:h-8" />

            <!-- Text -->
            <p class="text-2xl font-bold o-ph:text-base o-md:text-xl">shyk</p>
        </Link>

        <!-- Container for Link Elements -->
        <div class="flex items-center justify-center ph:hidden md:flex">
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
        <Searchbar class="ml-32 ph:hidden md:flex o-md:ml-2" />

        <!-- Dropdown Menu -->

        <NavBarDropdownMenu class="ph:block md:hidden" />

        <AdminDropDown v-if="auth.user" class="ph:hidden lph:flex"/>
        <!-- Login Logout -->
        <NavBarUserSettings v-if="auth.user" />

        <div v-else class="ph:ml-2 lg:ml-8">
            <Link
                :href="route('login')"
                class="text-gray-700 dark:text-gray-500 ph:text-xs lg:text-sm"
                >Anmelden</Link
            >
            <br class="hidden o-ph:block" />

            <Link
                class="ml-2 text-gray-700 dark:text-gray-500 ph:text-xs lg:text-sm o-ph:ml-0"
                >Registrieren</Link
            >
        </div>
    </nav>
    <AdminDropDown v-if="auth.user" class="float-right ph:block lph:hidden m-2"/>
</template>

<script setup>
import Logo from "@/Components/svg/logo/Clean.vue";
import NavLink from "@/Components/NavLink.vue";
import Searchbar from "@/Components/forms/Searchbar.vue";
import { computed } from "vue";
import { Link, usePage } from "@inertiajs/inertia-vue3";
import NavBarDropdownMenu from "@/Components/NavBarDropdownMenu.vue";
import NavBarUserSettings from "@/Components/NavBarUserSettings.vue";
import AdminDropDown from "@/Components/AdminDropDown.vue";

const auth = computed(() => usePage().props.value.auth);
</script>
