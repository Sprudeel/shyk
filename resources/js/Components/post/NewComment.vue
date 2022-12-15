<script setup>
import { Head, usePage, useForm } from "@inertiajs/inertia-vue3";
import Button from "@/Components/forms/Button.vue";
import Input from "@/Components/forms/Input.vue";
import InputError from "@/Components/forms/InputError.vue";
import Label from "@/Components/forms/Label.vue";
import TipTap from "@/Components/forms/TipTapEditor.vue";
import { computed, ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

const auth = computed(() => usePage().props.value.auth);

const form = useForm({
    parent_id: usePage().props.value.post.id,
    content: "Kommentiere etwas...",
});

const submit = () => {
    form.post(route("comment.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset("content");
        },
    });
};
</script>

<template>
    <div class="grid w-full grid-cols-7 grid-rows-1 items-center gap-4 p-2">
        <div class="col-span-1 w-fit">
            <span class="relative flex w-fit">
                <img
                    :src="
                        Inertia.page.props.ziggy.url +
                        '/avatars/' +
                        auth.user.avatar
                    "
                    class="h-20 w-20 rounded-full object-cover"
                />
                <span
                    v-if="auth.user.role.name !== 'User'"
                    class="absolute top-0 right-0 flex h-6 w-6 items-center justify-center rounded-full bg-red-500"
                >
                    <div v-html="auth.user.role.symbol"></div
                ></span>
            </span>
        </div>
        <div class="col-span-6">
            <div class="flex flex-col">
                <form @submit.prevent="submit">
                    <div class="mt-8 mb-2">
                        <TipTap
                            @content="handleContent"
                            :content="form.content"
                            :maxChar="256"
                            v-model="form.content"
                            class="text-sm"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.content"
                        />
                    </div>

                    <Button
                        class="bg-shyk-blue float-right ml-8 hover:bg-blue-500 hover:font-bold hover:shadow-lg"
                        :class="{
                            'opacity-25': form.processing,
                        }"
                        :disabled="form.processing"
                    >
                        Kommentieren
                    </Button>
                </form>
            </div>
        </div>
    </div>
</template>
