<template>
    <Head title="Neues" />

    <DefaultLayout>
        <div class="lg:mx-32">
            <div class="relative m-8 mx-16 gap-16 pt-16 pb-8">
                <div id="pseudo-parent-working" class="">
                    <div id="stick">
                        <span id="icon">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                width="24"
                                height="24"
                            >
                                <path fill="#fff" d="M0 0h24v24H0z" />
                                <path
                                    fill="#14a7db"
                                    d="M6.455 19L2 22.5V4a1 1 0 0 1 1-1h18a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H6.455zm-.692-2H20V5H4v13.385L5.763 17zM11 10h2v2h-2v-2zm-4 0h2v2H7v-2zm8 0h2v2h-2v-2z"
                                />
                            </svg>
                        </span>
                        <div class="ml-6">
                            <div class="text-2xl font-bold text-gray-800">
                                Update v0.9.0?
                            </div>
                            <div class="text-gray-500">in der Zukunft!</div>
                        </div>
                    </div>
                </div>
                <div class="mt-2 ml-8">
                    shyk wird stets weiterentwickelt! Diese Entwicklung braucht
                    aber Zeit. Falls du aber interessante Ideen hast, kannst du
                    gerne auf
                    <a class="link" href="https://github.com/Sprudeel/shyk"
                        >GitHub</a
                    >
                    ein Issue erstellen. Wir werden dir dann Antworten. Auf
                    <a class="link" href="https://github.com/Sprudeel/shyk"
                        >GitHub</a
                    >
                    findest du auch unseren derzeitigen Arbeitssstand!
                </div>
                <div class="mt-2 ml-8">
                    Schonmal herzlichen Dank für dein Interesse an shyk! 🥰
                </div>
            </div>

            <div
                v-for="update in changelog"
                track-by="id"
                class="relative m-8 mx-16 grid-cols-4 gap-16 sm:grid"
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
                <div class="col-span-2 mt-2 ph:ml-8 lph:ml-8">
                    <div class="mb-6">{{ update.body }}</div>
                    <div class="mt-8 text-lg font-bold">Changelog</div>
                    <ul class="leading-10">
                        <li v-for="item in update.changes" class="mt-2">
                            {{ item }}
                        </li>
                    </ul>
                </div>
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

#pseudo-parent-working::before {
    content: "";
    position: absolute;
    left: 0;
    top: -4vh;
    bottom: -8vh;
    width: 2px;
    z-index: -10;
    background: rgb(20, 167, 219);
    background: linear-gradient(
        205deg,
        rgba(243, 218, 56, 1) 0%,
        rgba(20, 167, 219, 1) 30%,
        rgba(74, 222, 128, 1) 100%
    );
}
</style>

<script setup>
import DefaultLayout from "@/Layouts/Default.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const changelog = ref([
    {
        name: "Feinschliff",
        version: "v0.8.0",
        date: "1. Januar 2023",
        stage: "finished",
        changes: [
            "✨ Diese Seite wurde hinzugefügt",
            "✨ Mail Aktivierung des Accounts ist nun obligatorisch",
            "✨ Nutzungsbestimmungen hinzugefügt",
            "✨ Hilfe Seite beantwortet nun brennende Fragen",
            "✨ Alle Kategorien und Themen hinzugefügt",
            "🧪 Tests funktionieren nun ohne extra Datenbank Seeding",
            "🐛 Dropdown Navigationsleisten Menu funktioniert nun richtig",
        ],
        body: "Der letzte Feinschliff vor der Veröffentlichung. Keine Angst diese Applikation wird auch in Zukunft noch weiterentwickelt. Vielleicht sind hier bald auch deine Beteiligungen aufgelistet? 🚀",
    },
    {
        name: "Suchen, Kommentieren und bessere Responsivität!",
        version: "v0.7.0",
        date: "16. Dezember 2022",
        stage: "finished",
        changes: [
            "✨ Posts können nun durchsucht werden",
            "✨ Kommentarsystem hinzugefügt",
            "🧪 Tests würden hinzugefügt für Posts und Entdecken",
            "🐛 Responsivität wurde verbessert",
        ],
        body: "Kleines Update mit zwei wichtigen Features! 🚀",
    },
    {
        name: "Forum Grundstrukturen",
        version: "v0.6.0",
        date: "29. November 2022",
        stage: "finished",
        changes: [
            "✨ Entdecken Seite hinzugefügt",
            "✨ Dynamische Themen Banner hinzugefügt",
            "✨ Pagination für Posts hinzugefügt",
            "✨ Forum Menu hinzugefügt",
            "✨ Post Overview Component hinzugefügt",
            "✨ Post erstellen, ansehen, bearbeiten und löschen hinzugefügt",
            "✨ Datei Upload mittels FilePond hinzugefügt",
            "✨ Posts können geliked werden",
            "✨ Posts können verifiziert werden",
            "🧪 Tests würden hinzugefügt für Posts und Entdecken",
            "🐛 TipTap Editor: maxChar kann nun als Attribut gesetzt werden",
            "🔐 Nutzer Email wird nun standartmässig nicht mehr ins Public Payload geladen",
            "✨ Posts Berechtigungen hinzugefügt",
        ],
        body: "Dies ist wahrscheinlich das grösste Update, dass kommen wird. Es beinhaltet fast die gesamte Grundstruktur fürs Forum. Von Posten, Entdecken bis hin zu liken, fast alles ist dabei! 🚀",
    },
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
