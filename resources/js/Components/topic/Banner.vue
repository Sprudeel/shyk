<script setup>
import SmartLogo from "@/Components/svg/logo/Smart.vue";

const props = defineProps({
    topic: Object,
});
</script>

<template>
    <div v-if="props.topic === null">
        <div class="mx-auto flex w-full flex-row items-center bg-slate-200">
            <span class="m-4 basis-1/3">
                <SmartLogo class="mx-auto h-48" />
            </span>
            <div class="mr-12 basis-2/3">
                <h2 class="text-4xl font-extrabold">Willkommen im Forum</h2>
                <p>
                    Suche nach Titeln, filtere nach Kategorien, gehe in ein
                    Subforum oder schau die aktuellen Trends an!
                </p>
            </div>
        </div>
    </div>

    <div v-if="props.topic !== null">
        <div
            :style="
                'background: linear-gradient(120deg, ' +
                props.topic.color +
                ', ' +
                props.topic.gradient_to +
                ')'
            "
            class="flex h-32 items-center justify-center"
        >
            <span v-html="props.topic.icon" class="text-lg"> </span>
            <span class="ml-8 text-5xl font-extrabold">
                {{ props.topic.name }}</span
            >
        </div>
    </div>
</template>
