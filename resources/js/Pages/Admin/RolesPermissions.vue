<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";

const auth = computed(() => usePage().props.value.auth);

const props = defineProps({
    permissions: Object,
});
</script>

<template>
    <Head title="Admin - Rollen & Berechtigungen" />

    <DefaultLayout>
        <div class="py-12 px-12">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <h2 class="text-xl font-bold">
                            Berechtigungsdokumentation
                        </h2>
                        <ul class="m-8">
                            <li
                                class="list-disc"
                                v-for="permissions in permissions"
                            >
                                <span class="font-bold">{{
                                    permissions.name
                                }}</span>
                                <p class="ml-4">
                                    {{ permissions.explanation }}
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
