<template>
    <div class="flex items-center justify-center ph:hidden md:flex">
        <NavLink
            :href="route('admin/roles-permissions')"
            :active="route().current('admin/roles-permissions')"
            >Berechtigungen</NavLink
        >
        <NavLink
            :href="route('admin/roles-permissions/users')"
            :active="route().current('admin/roles-permissions/users')"
            >Nutzer</NavLink
        >
        <NavLink
            :href="route('admin/roles-permissions/roles')"
            :active="route().current('admin/roles-permissions/roles')"
            >Rollen</NavLink
        >
    </div>
</template>

<script setup>
import NavLink from "@/Components/NavLink.vue";
</script>
