<script setup>
import SmartLogo from "@/Components/svg/logo/Smart.vue";
import QuestionLogo from "@/Components/svg/logo/Question.vue";

const props = defineProps({
    topic: String,
    search: String,
});
</script>

<template>
    <div v-if="props.topic === null">
        <div
            class="mx-auto flex w-full flex-row items-center bg-slate-200 py-4"
        >
            <span class="m-4 basis-1/3">
                <SmartLogo class="mx-auto h-28" />
            </span>
            <div class="mr-12 basis-2/3">
                <h2 class="font-extrabold ph:text-lg lph:text-2xl md:text-4xl">
                    Willkommen im Forum!
                </h2>
                <p class="ph:hidden lph:block lph:text-lg md:text-xl">
                    Suche nach Titeln, filtere nach Kategorien, Themen oder
                    anderem!
                </p>
            </div>
        </div>
    </div>

    <div v-else-if="props.topic === 'search'">
        <div
            class="mx-auto flex w-full flex-row items-center bg-slate-200 py-4"
        >
            <span class="m-4 basis-1/3">
                <QuestionLogo class="mx-auto h-32" />
            </span>
            <div class="mr-12 basis-2/3">
                <h2 class="font-extrabold ph:text-lg lph:text-2xl md:text-4xl">
                    " {{ props.search }} "
                </h2>
                <p class="ph:hidden lph:block lph:text-lg md:text-xl">
                    wurde gesucht...
                </p>
            </div>
        </div>
    </div>

    <div v-else>
        <div
            :style="
                'background: linear-gradient(120deg, ' +
                props.topic.color +
                ', ' +
                props.topic.gradient_to +
                ')'
            "
            class="flex h-36 items-center justify-center"
        >
            <span v-html="props.topic.icon" class="text-lg"> </span>
            <span class="ml-8 text-5xl font-extrabold">
                {{ props.topic.name }}</span
            >
        </div>
    </div>
</template>
