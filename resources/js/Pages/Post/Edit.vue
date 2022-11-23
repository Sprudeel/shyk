<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { ref } from "vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";

const props = defineProps({
    topics: Object,
    categories: Object,
    post: Object,
});

function handleContent(s) {
    form.content = s;
}

const form = useForm({
    id: props.post.id,
    title: props.post.title,
    topic: props.post.topic,
    status: props.post.status,
    category: props.post.category,
    content: ref(props.post.content),
    file: props.post.file,
});

const submit = () => {
    form.post(route("post.update"));
};
</script>

<template>
    <Head title="Post bearbeiten" />

    <DefaultLayout>
        <div class="py-12">
            <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
                <h2 class="mb-2 text-2xl font-bold">Post erstellen</h2>
                <form @submit.prevent="submit">
                    <div>
                        <Label for="title" value="Titel" />
                        <Input
                            id="title"
                            type="text"
                            class="mt-1 block w-full font-bold"
                            v-model="form.title"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.title" />
                    </div>

                    <div class="mt-4 flex w-full flex-row space-x-8">
                        <div class="w-full">
                            <Label for="subject" value="Thema" />
                            <select
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="subject"
                                id="subject"
                                v-model="form.topic"
                            >
                                <option
                                    v-for="topic in props.topics"
                                    :value="topic.slug"
                                >
                                    {{ topic.name }}
                                </option>
                            </select>
                            <InputError
                                class="mt-2"
                                :message="form.errors.topic"
                            />
                        </div>

                        <div class="w-full">
                            <Label for="category" value="Kategorie" />
                            <select
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="category"
                                id="category"
                                v-model="form.category"
                            >
                                <option
                                    v-for="category in props.categories"
                                    :value="category.slug"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                            <InputError
                                class="mt-2"
                                :message="form.errors.category"
                            />
                        </div>

                        <div class="w-full">
                            <Label for="status" value="Sichtbarkeit" />
                            <select
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="status"
                                id="status"
                                v-model="form.status"
                            >
                                <option value="private">Privat</option>
                                <option value="public">Öffentlich</option>
                            </select>
                            <InputError
                                class="mt-2"
                                :message="form.errors.status"
                            />
                        </div>
                    </div>
                    <div class="mt-8 mb-2">
                        <TipTap
                            @content="handleContent"
                            :content="form.content"
                            :maxChar="3000"
                            v-model="form.content"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.content"
                        />
                    </div>

                    <div class="mb-8">
                        <Label
                            class="mb-2 flex flex-row"
                            title="Zurzeit können nur PDFs und Bilder als Anhang angefügt werden!"
                        >
                            Anhang
                        </Label>
                        <input
                            type="file"
                            id="file"
                            accept=".pdf, .png, .jpeg, .jpg"
                            @input="form.file = $event.target.files[0]"
                        />
                        <InputError class="mt-2" :message="form.errors.file" />
                    </div>
                    <progress
                        v-if="form.progress"
                        :value="form.progress.percentage"
                        max="100"
                    >
                        {{ form.progress.percentage }}%
                    </progress>

                    <Button
                        class="bg-shyk-blue float-right ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                        :class="{
                            'opacity-25': form.processing,
                        }"
                        :disabled="form.processing"
                    >
                        Speichern
                    </Button>
                </form>
            </div>
        </div>
    </DefaultLayout>
</template>
