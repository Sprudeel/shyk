<template>
    <footer class="flex items-center bg-gray-800 p-8 text-white o-ph:gap-4">
        <LogoMeditating class="h-40 w-40 flex-1" />

        <div class="flex-1">
            <span class="text-4xl font-bold o-ph:text-2xl">shyk</span>
            <span class="ml-4 text-lg font-semibold italic o-ph:text-sm"
                >Testumbegung</span
            >
            <p class="mt-2 o-ph:text-sm">v0.0.1 alpha</p>
            <p class="o-ph:text-sm">Entwickelt von Léonard Schafer</p>
            <p class="o-ph:text-sm">Unterstützt durch Hermelin@PfadiPatria</p>
        </div>

        <div class="flex-1 ph:hidden md:block">Was kommt hier noch?</div>
    </footer>
</template>

<script setup>
import LogoMeditating from "@/Components/svg/logo/Meditating.vue";
</script>
