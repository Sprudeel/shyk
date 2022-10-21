<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import AuthBG from "@/Components/svg/bg/AuthBG.svg";
import HelloLogo from "@/Components/svg/logo/Hello.vue";
</script>

<template>
    <div class="w-ful h-full">
        <div
            class="auth-bg flex h-screen w-screen flex-col items-center bg-gray-100 pt-6 sm:justify-center sm:pt-0"
        >
            <div>
                <Link href="/">
                    <HelloLogo
                        class="h-36 w-36 fill-current text-gray-500 drop-shadow-lg"
                    />
                </Link>
            </div>

            <div
                class="mt-6 w-full overflow-hidden bg-white px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
            >
                <slot />
            </div>
        </div>
    </div>
</template>
