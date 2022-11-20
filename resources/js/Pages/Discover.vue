<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "@/Components/topic/Banner.vue";
import ForumMenu from "@/Components/topic/ForumMenu.vue";

const props = defineProps({
    topic: Object,
});
</script>

<template>
    <Head title="Entdecke" />

    <DefaultLayout>
        <Banner :topic="props.topic" />

        <div class="mt-8 grid h-screen grid-cols-3 gap-16">
            <div class="col-span-1 h-full justify-self-end">
                <div>
                    <ForumMenu />
                </div>
            </div>
            <div class="col-span-2 h-full w-full bg-red-600">s</div>
        </div>
    </DefaultLayout>
</template>
