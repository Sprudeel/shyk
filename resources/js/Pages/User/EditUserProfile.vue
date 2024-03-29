<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, useForm } from "@inertiajs/inertia-vue3";
import { Inertia } from "@inertiajs/inertia";
import { computed, ref } from "vue";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";

const props = defineProps({
    User: Object,
    avatar_path: String,
});

const auth = computed(() => usePage().props.value.auth);

let form = useForm({
    id: props.User.id,
    username: props.User.username,
    email: props.User.email,
    name: props.User.name,
    avatar: props.User.avatar,
    about: ref(props.User.about),
});

function handleContent(s) {
    form.about = s;
}

let imageURL = [null];
let imageKey = ref(0);

function previewImage() {
    imageURL.splice(0);
    const file = form.avatar;
    imageURL.push(URL.createObjectURL(file));
}

const submit = () => {
    form.post(route("userprofile.update"));
};
</script>

<template>
    <Head :title="User.username + 's Profil'" />

    <DefaultLayout>
        <div class="mx-auto mt-4 mb-8 h-full w-5/6">
            <form @submit.prevent="submit">
                <div
                    class="relative flex ph:flex-col md:flex-row md:items-center md:divide-x"
                >
                    <div class="mt-8 mb-8 basis-1/3">
                        <label for="imageInput">
                            <Label class="ml-10">Avatar</Label>

                            <div
                                class="group relative mb-4 h-52 max-h-64 cursor-pointer overflow-hidden"
                            >
                                <input
                                    type="file"
                                    id="imageInput"
                                    accept=".png, .jpg, .jpeg"
                                    class="hidden"
                                    @input="
                                        form.avatar = $event.target.files[0];
                                        previewImage();
                                        imageKey++;
                                    "
                                />
                                <img
                                    id="previewAvatar"
                                    v-if="imageURL[0]"
                                    :src="imageURL[0]"
                                    :key="imageKey"
                                    class="mx-auto mt-2 mb-2 h-48 w-48 rounded-full object-cover"
                                />

                                <img
                                    v-else
                                    :src="
                                        Inertia.page.props.ziggy.url +
                                        '/avatars/' +
                                        form.avatar
                                    "
                                    class="mx-auto mt-2 mb-2 h-48 w-48 rounded-full object-cover"
                                />

                                <span class="hidden">{{ imageKey }}</span>
                                <span
                                    class="group absolute top-0 bottom-0 h-full w-full bg-transparent"
                                >
                                    <span
                                        class="group flex h-full items-center justify-center bg-transparent"
                                    >
                                        <span
                                            class="group hidden h-12 w-12 rounded-full p-24 group-hover:block group-hover:bg-gray-400/50"
                                        ></span
                                    ></span>
                                </span>
                            </div>
                        </label>
                        <InputError
                            class="mb-2"
                            :message="form.errors.avatar"
                        />
                        <div class="ml-0">
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
                                    class="mb-2"
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
                                class="mb-2"
                                :message="form.errors.name"
                            />
                            <Label for="email" value="E-Mail" />
                            <Input
                                id="email"
                                type="email"
                                class="mt-1 mb-4 block w-5/6"
                                v-model="form.email"
                                disabled
                                required
                                autofocus
                                title="Deine Email kann nicht geändert werden!"
                            />
                            <InputError
                                class="mb-2"
                                :message="form.errors.email"
                            />
                        </div>
                    </div>

                    <div class="basis-2/3 p-8">
                        <h2 class="text-lg font-bold">Über mich</h2>
                        <TipTap
                            @content="handleContent"
                            :content="form.about"
                            :maxChar="500"
                            v-model="form.about"
                        />
                    </div>
                    <div class="absolute bottom-10 right-10">
                        <progress
                            v-if="form.progress"
                            :value="form.progress.percentage"
                            max="100"
                        >
                            {{ form.progress.percentage }}%
                        </progress>
                        <span v-if="form.progress" class="ml-2">
                            {{ form.progress.percentage }} %
                        </span>
                        <Button
                            class="bg-shyk-blue ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                            :class="{
                                'opacity-25': form.processing,
                            }"
                            :disabled="form.processing"
                        >
                            Upload
                        </Button>
                    </div>
                </div>
            </form>
        </div>
    </DefaultLayout>
</template>
