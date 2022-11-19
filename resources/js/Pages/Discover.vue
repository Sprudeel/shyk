<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import Banner from "@/Components/topic/Banner.vue";

const props = defineProps({
    topic: Object,
});

const user = computed(() => usePage().props.value.auth.user);
const role = computed(() => usePage().props.value.auth.role);
const permissions = computed(() => usePage().props.value.auth.permissions);
</script>

<template>
    <Head title="Entdecke" />

    <DefaultLayout>
        <Banner :topic="props.topic" />

        <div class="grid h-screen grid-cols-3">
            <div class="col-span-1 h-full w-full">
                <Button>Post erstellen</Button>
            </div>
            <div class="col-span-2 h-full w-full bg-red-600">s</div>
        </div>
    </DefaultLayout>
</template>
