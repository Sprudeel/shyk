<template>
    <div class="flex items-center justify-center ph:hidden md:flex">
        <NavLink
            :href="route('admin.role.permissions')"
            :active="route().current('admin.role.permissions')"
            >Berechtigungen</NavLink
        >
        <NavLink
            :href="route('admin.role.users')"
            :active="route().current('admin.role.users')"
            >Nutzer</NavLink
        >
        <NavLink
            :href="route('admin.role.roles')"
            :active="route().current('admin.role.roles')"
            >Rollen</NavLink
        >
    </div>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>
