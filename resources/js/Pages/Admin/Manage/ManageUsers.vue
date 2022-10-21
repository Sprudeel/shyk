<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";

defineProps(["users"]);
</script>

<template>
    <Head title="Admin - Nutzer" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <Table :resource="users">
                            <template #cell(actions)="{ item: user }">
                                <a :href="`users/edit/${user.id}`"> Edit </a>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
