<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head, usePage, useForm } from "@inertiajs/inertia-vue3";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";
import { computed, ref } from "vue";

// Import Vue FilePond
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
import FilePondPluginFileMetadata from "filepond-plugin-file-metadata";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";

const FilePond = vueFilePond(
    FilePondPluginFileValidateType,
    FilePondPluginImagePreview,
    FilePondPluginFileMetadata,
    FilePondPluginFileValidateSize
);

const props = defineProps({
    topics: Object,
    categories: Object,
    csrf_token: String,
});

let forceUpdate = ref(0);

const auth = computed(() => usePage().props.value.auth);

const handleFilePondInit = () => {
    setOptions({
        credits: false,
        server: {
            process: "/tmpupload",
            revert: "/tmpdelete",
            headers: {
                "X-CSRF-TOKEN": props.csrf_token,
            },
        },
        fileMetadataObject: {
            folder: (Math.random() + 1).toString(36).substring(7),
        },
        maxFiles: 3,
        maxFileSize: "20MB",
        labelMaxFileSizeExceeded: "File is too large",
        labelMaxFileSize: "Maximum file size is {filesize}",
    });
};

function handleContent(s) {
    form.about = s;
}

const form = useForm({
    title: null,
    topic: null,
    status: null,
    category: null,
    content: "Hier darfst du deinen Post schreiben. Viel Spass!",
    attachements: [],
});

const submit = () => {
    form.post(route("post.store"), { forceFormData: true });
};

const handleFilePondProcess = (error, file) => {
    form.attachements.push({ id: file.id, serverId: file.serverId });
};
const handleFilePondRemoveFile = (error, file) => {
    form.attachements = form.attachements.filter((item) => item.id !== file.id);
};
</script>

<template>
    <Head title="Post erstellen" />

    <DefaultLayout>
        <div class="py-12">
            <div class="max-w-6xl ph:mr-4 ph:ml-4 sm:mx-auto sm:px-6 lg:px-8">
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
                            Anhang (maximal 3 Dateien, maximal 20MB pro Datei)
                        </Label>
                        <file-pond
                            name="file"
                            id="file"
                            ref="filepondInput"
                            label-idle="Drop files here..."
                            allow-multiple="true"
                            :data-file-metadata-folder="
                                (Math.random() + 1).toString(36).substring(7)
                            "
                            accepted-file-types="audio/*, video/*, image/*, application/pdf, .doc, .docx, .xls, .xlsx, .ppt, .pptx, .odt, .ods, .odp, .txt, .rtf, .csv, .zip, .rar, .tar, .7z"
                            v-bind:files="form.file"
                            maxFiles="3"
                            @init="handleFilePondInit"
                            @processfile="handleFilePondProcess"
                            @removefile="handleFilePondRemoveFile"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.attachements"
                        />
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
