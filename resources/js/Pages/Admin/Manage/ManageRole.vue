<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Navigation from "@/Pages/Admin/Manage/Navigation.vue";
import Button from "@/Components/forms/Button.vue";
import Checkbox from "@/Components/forms/Checkbox.vue";
import { Inertia } from "@inertiajs/inertia";
import { onMounted } from "vue";

const props = defineProps({
    role: Object,
    role_permissions: Object,
    permissions: Object,
});

let perm = [];

function updateForm() {
    for (let index = 0; index < props.permissions.length; index++) {
        let foundMatch = false;
        for (let index2 = 0; index2 < props.role_permissions.length; index2++) {
            if (
                props.permissions[index].id == props.role_permissions[index2].id
            ) {
                foundMatch = true;
            }
        }
        if (foundMatch == true) {
            perm.push({
                permission_id: props.permissions[index].id,
                permission_name: props.permissions[index].name,
                permission_explanation: props.permissions[index].explanation,
                haspermission: true,
            });
        } else {
            perm.push({
                permission_id: props.permissions[index].id,
                permission_name: props.permissions[index].name,
                permission_explanation: props.permissions[index].explanation,
                haspermission: false,
            });
        }
    }
}

updateForm();

let form = useForm({
    role_id: props.role.id,
    permissions: perm,
});

console.log(form);

const submit = () => {
    Inertia.post(route("admin.role.edit"), form);
};
</script>

<template>
    <Head title="Admin - Rolle bearbeiten" />

    <DefaultLayout>
        <div class="py-8">
            <Navigation />
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 bg-white p-6">
                        <h2 class="ml-4 text-lg">
                            Berechtigungen Rolle
                            <span class="shyk-blue font-bold">{{
                                role.name
                            }}</span>
                            bearbeiten
                        </h2>
                        <div class="mx-16 mt-8">
                            <form @submit.prevent="submit">
                                <div class="grid grid-cols-3">
                                    <label
                                        v-for="permission in form.permissions"
                                        class=""
                                    >
                                        <Checkbox
                                            name="remember"
                                            v-model:checked="
                                                permission.haspermission
                                            "
                                        />
                                        <span class="text-md ml-2 text-black">{{
                                            permission.permission_name
                                        }}</span>
                                        <br />
                                        <span
                                            class="ml-8 text-xs text-gray-600"
                                            >{{
                                                permission.permission_explanation
                                            }}</span
                                        >
                                    </label>
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
