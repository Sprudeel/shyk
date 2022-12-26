<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronUpIcon } from "@heroicons/vue/20/solid";

const faq = ref([
    {
        question: "Was ist shyk?",
        answer: "shyk ist eine Online Austauschplattform für Schüler:innen der SekII. Hier kannst du Ressourcen teilen, suchen und herunterladen!",
    },
    {
        question: "Wo kann ich mich anmelden?",
        answer: "Um dich anzumelden klicke in der Navigationsleiste auf 'Anmelden'.",
    },
    {
        question: "Darf ich hier alles veröffentlichen?",
        answer: "Grundsätzlich ja, jedoch haftest du für Urheberrechtsschäden. Für genauere Infos konsultiere doch die Nutzungsbedingungen.",
    },
]);
</script>

<template>
    <Head title="Hilfe" />

    <DefaultLayout>
        <div class="mx-16 mt-8 lg:mx-32">
            <h1 class="text-4xl font-bold">Hilfe</h1>
            <p>
                Suchst du eine Antwort auf deine Frage? Dann bist du hier genau
                richtig! Weiter unten findest du eine Kollektion von den meist
                gefragten Fragen. Falls du dort auch nicht weiterkommst, dann
                kannst du gerne ein Mail an help( ät )shyk.ch senden!
            </p>
            <p class="mt-4 mb-4 text-xl font-bold">Oft Gefragte Fragen</p>
            <div>
                <div class="mb-8">
                    <Disclosure v-slot="{ open }" v-for="question in faq">
                        <DisclosureButton
                            class="shyk-blue text-md mt-4 flex w-full justify-between rounded-lg bg-blue-100 px-4 py-2 text-left font-bold hover:bg-blue-200 focus:outline-none focus-visible:ring focus-visible:ring-blue-500 focus-visible:ring-opacity-75"
                        >
                            <span>{{ question.question }}</span>
                            <ChevronUpIcon
                                :class="open ? 'rotate-180 transform' : ''"
                                class="shyk-blue h-5 w-5"
                            />
                        </DisclosureButton>
                        <DisclosurePanel class="px-4 pt-4 pb-2 text-sm">
                            {{ question.answer }}
                        </DisclosurePanel>
                    </Disclosure>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
