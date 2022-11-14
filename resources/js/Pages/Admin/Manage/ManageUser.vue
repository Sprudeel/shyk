<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
    user: Object,
    roles: Object,
    errors: Object,
});

let form = useForm({
    id: props.user.id,
    username: props.user.name,
    email: props.user.email,
    role_id: props.user.role_id,
});

const submit = () => {
    form.post(route("admin.role.user.edit"));
};
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
                        <div class="mx-16 mt-8">
                            <form @submit.prevent="submit">
                                <div class="mb-4">
                                    <Label
                                        for="username"
                                        value="Benutzername"
                                    />
                                    <Input
                                        id="username"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.username"
                                        required
                                        autofocus
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.username"
                                    />
                                </div>

                                <div class="mb-4">
                                    <Label for="email" value="E-Mail" />
                                    <Input
                                        id="email"
                                        type="email"
                                        class="mt-1 block w-full"
                                        v-model="form.email"
                                        required
                                    />
                                    <InputError
                                        class="mt-2"
                                        :message="form.errors.email"
                                    />
                                </div>

                                <div class="mb-4">
                                    <Label for="roles" value="Rolle" />
                                    <select
                                        class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                        name="roles"
                                        id="roles"
                                        v-model="form.role_id"
                                    >
                                        <option
                                            v-for="role in roles"
                                            :key="role.id"
                                            :value="role.id"
                                        >
                                            {{ role.name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-4 flex items-center justify-end">
                                    <Button
                                        class="bg-shyk-blue ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                                        :class="{
                                            'opacity-25': form.processing,
                                        }"
                                        :disabled="form.processing"
                                    >
                                        Bearbeiten
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
