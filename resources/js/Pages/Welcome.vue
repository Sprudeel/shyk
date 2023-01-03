<template>
    <Head title="Home" />

    <DefaultLayout>
        <div
            class="mt-2 grid grid-flow-row grid-cols-1 grid-rows-4 items-center sm:grid-cols-2 sm:grid-rows-2 md:gap-y-4 xl:mx-32"
        >
            <div class="justify-self-center ph:w-6/12 sm:w-8/12 lg:w-6/12">
                <HeroLogo1 class="overflow-x-hidden" />
            </div>

            <div class="mx-auto w-10/12">
                <h2 class="text-xl font-bold md:text-2xl xl:text-3xl">
                    Willkommen auf <span class="shyk-blue">shyk</span>!
                </h2>
                <p class="">
                    Suche, teile, entdecke, lerne, kommentiere und tausche dich
                    mit anderen aus! <br> Nun gehe auf Entdeckung und finden neues!
                </p>
                <br />
                <Link :href="route('discover')">
                    <Button
                        class="bg-shyk-blue hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                        >Entdecken!</Button
                    ></Link
                >
            </div>

            <div class="justify-self-center ph:w-6/12 sm:hidden md:w-11/12">
                <HeroLogo2 class="overflow-x-hidden" />
            </div>

            <div class="mx-auto w-10/12">
                <h2 class="text-xl font-bold md:text-2xl xl:text-3xl">
                    Was ist <span class="shyk-yellow">shyk</span>?
                </h2>
                <p class="max-w-xl">
                    shyk enstand im Rahmen einer Maturaarbeit und ist alles
                    Austauschplattform für alle Schüler:innen der SekII gedacht
                </p>
            </div>

            <div class="w-11/12 justify-self-center ph:hidden sm:block">
                <HeroLogo2 class="overflow-x-hidden" />
            </div>
        </div>

        <!-- <h2
            class="ml-16 text-2xl font-bold md:ml-8 lg:ml-12 lg:text-3xl xl:ml-40"
        >
            shyk in Zahlen
        </h2>

        <div
            class="justify-center gap-16 ph:m-8 ph:grid ph:grid-cols-2 ph:grid-rows-2 ph:items-center ph:gap-4 md:flex md:gap-4"
        >
            <div
                class="w-full justify-self-center rounded-xl border border-slate-400 text-center ph:p-6 sm:p-12"
            >
                <span class="text-2xl font-extrabold">1,000</span>
                <p class="text-gray-600">Posts</p>
            </div>

            <div
                class="w-full justify-self-center rounded-xl border border-slate-400 text-center ph:p-6 sm:p-12"
            >
                <span class="text-2xl font-extrabold">1,000</span>
                <p class="text-gray-600">Nutzer</p>
            </div>

            <div
                class="w-full justify-self-center rounded-xl border border-slate-400 text-center ph:p-6 sm:p-12"
            >
                <span class="text-2xl font-extrabold">1,000</span>
                <p class="text-gray-600">Kommentare</p>
            </div>

            <div
                class="w-full justify-self-center rounded-xl border border-slate-400 text-center ph:p-6 sm:p-12"
            >
                <span class="text-2xl font-extrabold">1,000</span>
                <p class="text-gray-600">Likes</p>
            </div>
        </div> -->

        <br />
        <br />
    </DefaultLayout>
</template>

<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import HeroLogo1 from "@/Components/svg/herologos/1.vue";
import HeroLogo2 from "@/Components/svg/herologos/2.vue";
import Button from "@/Components/forms/Button.vue";

const props = defineProps({
    laravelVersion: String,
    phpVersion: String,
});
</script>
