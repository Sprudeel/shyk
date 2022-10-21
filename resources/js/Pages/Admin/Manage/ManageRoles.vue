<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Button from "@/Components/forms/Button.vue";
import { Table } from "@protonemedia/inertiajs-tables-laravel-query-builder";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";
import { PencilSquareIcon, TrashIcon } from "@heroicons/vue/24/outline";

defineProps(["roles"]);
</script>

<template>
    <Head title="Admin - Rollen" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="max-w-10/12 mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <Link :href="route('admin.role.create.form')"
                            ><Button
                                class="bg-shyk-blue m-4 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                            >
                                Erstellen
                            </Button>
                        </Link>
                        <Table :resource="roles" class="w-full">
                            <template #cell(actions)="{ item: role }">
                                <div class="flex flex-row">
                                    <Link :href="`role/edit/${role.id}`">
                                        <PencilSquareIcon
                                            class="shyk-blue mr-2 h-5 w-5"
                                        />
                                    </Link>

                                    <Link
                                        :href="`role/delete/${role.id}`"
                                        method="post"
                                    >
                                        <TrashIcon
                                            class="mr-0 h-5 w-5 text-red-500"
                                        />
                                    </Link>
                                </div>
                            </template>
                        </Table>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
