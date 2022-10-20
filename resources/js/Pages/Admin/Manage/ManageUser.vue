<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";
import Button from "@/Components/forms/Button.vue";

defineProps(["user", "roles"]);
</script>

<template>
    <Head title="Admin - Nutzer bearbeiten" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <h2 class="ml-4 text-lg font-bold">
                            Nutzer bearbeiten
                        </h2>

                        <form @submit.prevent="submit">
                            <Button></Button>
                            <div class="group relative z-0 m-4 mb-6 w-full">
                                <input
                                    type="email"
                                    name="floating_email"
                                    id="floating_email"
                                    class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent py-2.5 px-0 text-sm text-gray-900 focus:border-blue-600 focus:outline-none focus:ring-0 dark:border-gray-600 dark:text-white dark:focus:border-blue-500"
                                    placeholder=" "
                                    required
                                />
                                <label
                                    for="floating_email"
                                    class="absolute top-3 -z-10 origin-[0] -translate-y-6 scale-75 transform text-sm text-gray-500 duration-300 peer-placeholder-shown:translate-y-0 peer-placeholder-shown:scale-100 peer-focus:left-0 peer-focus:-translate-y-6 peer-focus:scale-75 peer-focus:font-medium peer-focus:text-blue-600 dark:text-gray-400 peer-focus:dark:text-blue-500"
                                    >Email address</label
                                >
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center pl-3"
                                >
                                    <svg
                                        aria-hidden="true"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"
                                        ></path>
                                        <path
                                            d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
