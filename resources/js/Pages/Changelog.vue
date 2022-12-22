<template>
    <Head title="Neues" />

    <DefaultLayout>
        <div
            v-for="update in changelog"
            track-by="id"
            class="relative m-8 mx-16 grid grid-cols-4 gap-16"
        >
            <div id="pseudo-parent-finished" class="col-span-2">
                <div id="stick">
                    <span id="icon" v-if="update.stage == 'finished'">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="#fff"
                            viewBox="0 0 32 32"
                            stroke-width="1.5"
                            stroke="#22c55e"
                            class="h-8 w-8"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                            />
                        </svg>
                    </span>
                    <div class="ml-6">
                        <div class="text-2xl font-bold text-gray-800">
                            Update {{ update.version }}:
                            <span class="text-2xl font-extrabold">{{
                                update.name
                            }}</span>
                        </div>
                        <div class="text-gray-500">{{ update.date }}</div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 mt-2">
                <div class="mb-6">{{ update.body }}</div>
                <div class="mt-8 text-lg font-bold">Changelog</div>
                <ul class="leading-10">
                    <li v-for="item in update.changes" class="mt-2">
                        {{ item }}
                    </li>
                </ul>
            </div>
        </div>
    </DefaultLayout>
</template>

<style>
#stick {
    position: sticky;
    top: 5vh;
}
#icon {
    position: absolute;
    z-index: 1;
    left: -11px;
    top: 0;
}
#pseudo-parent-finished::before {
    content: "";
    position: absolute;
    left: 0;
    top: -4vh;
    bottom: -8vh;
    width: 2px;
    z-index: -10;
    background-color: #4ade80;
}
</style>

<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const changelog = ref([
    {
        name: "Melden, Flash Nachrichten und mehr!",
        version: "v0.5.0",
        date: "19. November 2022",
        stage: "finished",
        changes: [
            "✨ Nutzerprofile können gemeldet werden",
            "🐛 Responsive Design für Default Layout verbessert",
            "🐛 TipTap Editor: Zeichen und Wörter Information sind nun im Editor und schweben nicht mehr herum",
            "✨ Verbesserter Hover Icon Effekt",
            "🧪 Userprofile Tests: Avatar Upload wird nun getestet",
            "🐛 Dropdowns schweben nun über anderen Elementen",
            "✨ Flash Nachrichten hinzugefügt",
            "🏗 Berechtigungs Architektur überarbeitet",
            "✨ Verbessertes Footer Design hinzugefügt",
            "✨ Log Viewer hinzugefügt",
        ],
        body: "Kleine Quality of Life änderungen 🚀",
    },
    {
        name: "Aufgeräumt und Bugfixes",
        version: "v0.4.1",
        date: "14. November 2022",
        stage: "finished",
        changes: [
            "❌ Unnötiger Archivo Font entfernt",
            "🧪 Testnamen angepasst",
            "✨ Favicon hinzugefügt",
            "🐛 Berechtigungen für Admindropdown gefixt",
            "🐛 ID Seeding vom Role Seeder entfernt (entfernt auto_increment fehler)",
            "✨ Stage & Version in der .env Datei hinzugefügt",
        ],
        body: "Kleine Bugfixes und das lang erwartete Favicon. 🖼️🚀",
    },
    {
        name: "Nutzerprofile und Formerror Handling",
        version: "v0.4.0",
        date: "13. November 2022",
        stage: "finished",
        changes: [
            "✨ Nutzerprofile hinzugefügt",
            "✨ Nutzerprofile bearbeiten hinzugefügt",
            "✨ TipTap Editor hinzugefügt",
            "🚀 Formerror Handling verbessert",
            "🧪 Tests für Nutzerprofile hinzugefügt",
        ],
        body: "Erstes grosses Update mit vielen neuen Features. Nutzerprofile wurden hinzugefügt, welche bearbeitet werden können. Außerdem wurde der TipTap Editor hinzugefügt, welcher als Editor für fast alle Textfelder verwendet wird. Das Formerror Handling wurde verbessert und es wurden Tests für die Nutzerprofile hinzugefügt. 🚀",
    },
    {
        name: "Laravel.conf Bugfix",
        version: "v0.3.1",
        date: "03. November 2022",
        stage: "finished",
        changes: ["🐛 Laravel.conf root richtig konfiguriert"],
        body: "Kleiner Bugfix in der NGINX Konfiguration. 🐛",
    },
    {
        name: "NGINX, Docker und mehr!",
        version: "v0.3.0",
        date: "02. November 2022",
        stage: "finished",
        changes: ["✨ Dockerfiles für Produktionsumgebung hinzugefügt"],
        body: "Kleines aber wichtiges Update, inwelchem die Dockerfiles und Logik für die Produktionsumgebung hinzugefügt wurde. 🚢🧪",
    },
    {
        name: "Rollen und Berechtigungen, Policies und mehr!",
        version: "v0.2.0",
        date: "21. Oktober 2022",
        stage: "finished",
        changes: [
            "✨ Rollen und Berechtigungen hinzugefügt",
            "✨ Policies für Backend Validierung hinzugefügt",
            "✨ Schöner Berechtigungsarray für Berechtigungsvaliderung im Frontend hinzugefügt",
            "✨ Berechtigungsvalidierung im Frontend hinzugefügt",
            "✨ Design für Authenfizierungsseiten hinzugefügt",
        ],
        body: "In diesem Update wurden die ersten Konzepte fürs Backend umgesetzt. Die Rollen und Berechtigungen! Alles wurde schön verknüpft und kann mittels UI dynamisch angepasst werden. Die Validierungen funktionieren im Front-, sowie auch Backend reibungslos umgesetzt. Zudem wurde noch der Hintergrund für die Authentifizierungsseiten hinzugefügt. 🚀",
    },
    {
        name: "Wilkommensseite und Navigationsmenu!",
        version: "v0.1.0",
        date: "19. Oktober 2022",
        stage: "finished",
        changes: [
            "✨ Wilkommensseite hinzugefügt",
            "✨ Navigationmenu hinzugefügt",
            "✨ responsiveness des Navigationsmenus verbessert",
            "✨ Continous Integration hinzugefügt",
        ],
        body: "In diesem ersten Update wurde die Wilkommensseite und das Navigationsmenu hinzugefügt. Das Navigationsmenu ist responsive und wird bei kleineren Bildschirmen zu einem Dropdown Menu. Außerdem wurde Continous Integration mit GitHub Actions hinzugefügt. Hoffentlich gibt es bald mehr zu testen! 🚀",
    },
]);
</script>
