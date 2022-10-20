<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Button from "@/Components/forms/Button.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";

defineProps(["roles"]);
</script>

<template>
    <Head title="Admin - Rollen" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <Link :href="route('admin.role.create.form')"
                            ><Button
                                class="bg-shyk-blue m-4 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                            >
                                Erstellen
                            </Button>
                        </Link>
                        <Table :resource="roles">
                            <template #cell(actions)="{ item: role }">
                                <a :href="`/role/${role.id}/edit`"> Edit </a>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
