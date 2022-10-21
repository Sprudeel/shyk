<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import { Inertia } from "@inertiajs/inertia";

let form = useForm({
    name: "",
});

let submit = () => {
    Inertia.post(route("admin.role.create"), form);
};
</script>

<template>
    <Head title="Admin - Rolle Erstellen" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <h2 class="ml-4 text-lg font-bold">Rolle Erstellen</h2>
                        <div class="mx-16 mt-8">
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <Label for="name" value="Rollenname" />
                                    <Input
                                        id="name"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.name"
                                        required
                                        autofocus
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.name"
                                    />
                                </div>

                                <div class="mt-4 flex items-center justify-end">
                                    <Button
                                        class="bg-shyk-blue ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Erstellen
                                    </Button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
