<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Banner from "@/Components/topic/Banner.vue";
import ForumMenu from "@/Components/topic/ForumMenu.vue";

const props = defineProps({
    topic: Object,
    topics: Object,
    categories: Object,
});
</script>

<template>
    <Head title="Entdecke" />

    <DefaultLayout>
        <Banner :topic="props.topic" />

        <div class="mt-8 grid h-screen grid-cols-3 gap-16">
            <div class="col-span-1 h-full justify-self-end">
                <div>
                    <ForumMenu
                        :topics="props.topics"
                        :categories="props.categories"
                    />
                </div>
            </div>
            <div class="col-span-2 h-full w-full bg-slate-200">
                {{ route().params.topic }}
            </div>
        </div>
    </DefaultLayout>
</template>
