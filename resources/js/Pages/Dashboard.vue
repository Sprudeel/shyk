<script setup>
import DefaultLayout from '@/Layouts/Default.vue';
import { Head, usePage } from '@inertiajs/inertia-vue3';
import { computed } from "vue";

const user = computed(() => usePage().props.value.auth.user);
const role = computed(() => usePage().props.value.auth.role);
const permissions = computed(() => usePage().props.value.auth.permissions);
</script>

<template>
    <Head title="Dashboard" />

    <DefaultLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <!-- {{ user.role.name }} -->
                        <br>
                        <br>
                        {{ permissions }}
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
