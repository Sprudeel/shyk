<script setup>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";
import { useForm } from "@inertiajs/inertia-vue3";
import Input from "@/Components/forms/Input.vue";

const form = useForm({
    search: "",
});

const submit = () => {
    form.get(route("topic.search", { search: form.search }));
};
</script>

<template>
    <div
        class="ml-8 inline-flex items-center justify-center rounded-md border bg-gray-200 p-1 pl-2"
    >
        <form @submit.prevent="submit">
            <div class="flex flex-row items-center">
                <label for="searchinput">
                    <MagnifyingGlassIcon class="h-5 w-5 text-gray-500" />
                </label>
                <Input
                    id="title"
                    type="text"
                    class="ml-2 mr-1 w-36 border-none bg-gray-200 text-xs text-gray-500 outline-none duration-150 focus:w-48 o-md:w-24"
                    placeholder="Suchen..."
                    v-model="form.search"
                    required
                />
            </div>
        </form>
    </div>
</template>
