<template>
    <Head title="Home" />

    <DefaultLayout>
        <div class="grid grid-flow-row grid-cols-2 grid-rows-2 items-center">
            <div class="mr-32 justify-self-end">
                <HeroLogo1 class="max-w-80 max-h-80 self-end" />
            </div>

            <div class="">
                <h2 class="text-3xl font-bold">
                    Willkommen auf <span class="shyk-blue">shyk</span>!
                </h2>
                <p class="max-w-xl">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                    aliquyam erat, sed diam voluptua. At vero eos et accusam et
                    justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                    sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
                <br />
                <Link :href="route('dashboard')">
                    <Button
                        class="bg-shyk-blue hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                        >Entdecken!</Button
                    ></Link
                >
            </div>

            <div class="ml-96">
                <h2 class="text-3xl font-bold">
                    Was ist <span class="shyk-yellow">shyk</span>?
                </h2>
                <p class="max-w-xl">
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                    diam nonumy eirmod tempor invidunt ut labore et dolore magna
                    aliquyam erat, sed diam voluptua. At vero eos et accusam et
                    justo duo dolores et ea rebum. Stet clita kasd gubergren, no
                    sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
            </div>

            <div class="mr-16 justify-self-start">
                <HeroLogo2 class="h-3/4 w-3/4" />
            </div>
        </div>

        <h2 class="ml-96 mt-16 mb-8 text-3xl font-bold">shyk in Zahlen</h2>

        <div class="flex justify-center gap-16">
            <div class="rounded-xl border border-slate-400 p-12 text-center">
                <span class="text-2xl font-extrabold">0</span>
                <p class="text-gray-600">Posts</p>
            </div>

            <div class="rounded-xl border border-slate-400 p-12 text-center">
                <span class="text-2xl font-extrabold">0</span>
                <p class="text-gray-600">Nutzer</p>
            </div>

            <div class="rounded-xl border border-slate-400 p-12 text-center">
                <span class="text-2xl font-extrabold">0</span>
                <p class="text-gray-600">Kommentare</p>
            </div>

            <div class="rounded-xl border border-slate-400 p-12 text-center">
                <span class="text-2xl font-extrabold">0</span>
                <p class="text-gray-600">Likes</p>
            </div>
        </div>

        <br />
        <br />
        <Footer />
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HeroLogo1 from "@/Components/svg/herologos/1.vue";
import HeroLogo2 from "@/Components/svg/herologos/2.vue";
import Button from "@/Components/forms/Button.vue";
import Footer from "@/Components/Footer.vue";

const props = defineProps({
    laravelVersion: String,
    phpVersion: String,
});
</script>
