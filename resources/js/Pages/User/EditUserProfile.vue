<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, useForm } from "@inertiajs/inertia-vue3";
import { computed, provide, ref } from "vue";
import LogoMeditating from "@/Components/svg/logo/Meditating.vue";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";

const props = defineProps({
    User: Object,
});

const auth = computed(() => usePage().props.value.auth);

let form = useForm({
    id: props.User.id,
    username: props.User.username,
    name: props.User.name,
    about: ref(props.User.about),
});

function handleContent(s) {
    form.about = s;
}

const submit = () => {
    Inertia.post(route("admin.role.user.edit"), form);
};
</script>

<template>
    <Head :title="User.username + 's Profil'" />

    <DefaultLayout>
        <div class="relative mx-auto mt-8 mb-8 h-full w-5/6 shadow-lg">
            <form @submit.prevent="submit">
                <div class="flex items-center divide-x">
                    <div class="mt-8 mb-8 basis-1/3">
                        <LogoMeditating
                            class="mx-auto mb-8 h-56 w-56 rounded-lg p-4"
                        />
                        <div class="ml-10">
                            <span class="items-center">
                                <Label for="username" value="Benutzername" />
                                <Input
                                    id="username"
                                    type="text"
                                    class="mt-1 mb-4 block w-5/6"
                                    v-model="form.username"
                                    required
                                    autofocus
                                />
                                <InputError
                                    class="mt-2"
                                    :message="form.errors.username"
                                />
                            </span>
                            <Label for="name" value="Vor- & Nachname" />
                            <Input
                                id="name"
                                type="text"
                                class="mt-1 mb-4 block w-5/6"
                                v-model="form.name"
                                required
                                autofocus
                            />
                            <InputError
                                class="mt-2"
                                :message="form.errors.name"
                            />
                            <br />
                        </div>
                    </div>

                    <div class="basis-2/3 p-8">
                        <h2 class="text-lg font-bold">Über mich</h2>
                        <TipTap
                            @content="handleContent"
                            :content="form.about"
                            v-model="form.about"
                        />
                    </div>
                </div>
            </form>
            <div v-html="form.about"></div>
        </div>
    </DefaultLayout>
</template>
