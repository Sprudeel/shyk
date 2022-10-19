<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { computed } from "vue";

const auth = computed(() => usePage().props.value.auth);
</script>

<template>
    <Head title="Admin - Rollen & Berechtigungen" />

    <DefaultLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        {{ permissions }}
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
