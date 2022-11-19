<script setup>
import { FlagIcon, XMarkIcon } from "@heroicons/vue/24/outline";
import { useForm } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import Label from "@/Components/forms/Label.vue";
import InputError from "@/Components/forms/InputError.vue";

const props = defineProps({
    user: Object,
});
let showReportModal = ref(false);

let form = useForm({
    reported_user: props.user.id,
    reported_user_name: props.user.username,
    reason: "",
});

const submit = () => {
    form.post(route("user.report"));
    showReportModal = false;
};
</script>

<template>
    <FlagIcon
        class="mr-2 h-8 w-8 cursor-pointer rounded-lg p-1 text-red-500 hover:bg-red-500 hover:text-white"
        title="Nutzer melden"
        @click="showReportModal = true"
    />
    <vue-final-modal
        v-model="showReportModal"
        classes="flex justify-center items-center"
        content-class="relative flex flex-col max-h-full min-w-1/3 mx-4 p-4 border dark:border-gray-800 rounded bg-white dark:bg-gray-900"
    >
        <div class="items-center justify-center pt-1">
            <XMarkIcon
                class="float-right h-5 cursor-pointer"
                @click="showReportModal = false"
            />
            <h2 class="mb-4 text-left text-lg font-bold">Nutzer melden</h2>
            <form @submit.prevent="submit">
                <Label for="username" value="Benutzername" />
                <Input
                    id="username"
                    type="text"
                    class="mt-1 mb-4 block w-5/6 cursor-not-allowed"
                    v-model="form.reported_user_name"
                    required
                    autofocus
                    disabled
                />

                <Label for="reason" value="Grund" class="mb-2" />
                <textarea
                    name="reason"
                    class="box-border max-w-full"
                    id="reason"
                    cols="60"
                    rows="3"
                    v-model="form.reason"
                ></textarea>
                <InputError class="mb-2" :message="form.errors.reason" />
                <br />
                <Button
                    class="bg-shyk-blue float-right mt-4 ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                    :class="{
                        'opacity-25': form.processing,
                    }"
                    :disabled="form.processing"
                >
                    melden!
                </Button>
            </form>
        </div>
    </vue-final-modal>
</template>
