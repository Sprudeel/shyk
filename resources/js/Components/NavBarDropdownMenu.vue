<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from "@headlessui/vue";
import {
    ChevronDownIcon,
    GlobeEuropeAfricaIcon,
    MagnifyingGlassIcon,
} from "@heroicons/vue/24/solid";
import {
    InformationCircleIcon,
    QuestionMarkCircleIcon,
} from "@heroicons/vue/24/outline";
</script>
<template>
    <div class="">
        <Menu as="div" class="relative inline-block text-left">
            <div>
                <MenuButton
                    class="inline-flex w-full justify-center rounded-md bg-opacity-20 px-4 py-2 text-sm font-medium text-black hover:bg-opacity-30 focus:outline-none focus-visible:ring-white focus-visible:ring-opacity-75"
                >
                    Navigieren
                    <ChevronDownIcon
                        class="ml-2 -mr-1 h-4 w-4 text-blue-300 hover:text-blue-600"
                        aria-hidden="true"
                    />
                </MenuButton>
            </div>

            <transition
                enter-active-class="transition duration-100 ease-out"
                enter-from-class="transform scale-95 opacity-0"
                enter-to-class="transform scale-100 opacity-100"
                leave-active-class="transition duration-75 ease-in"
                leave-from-class="transform scale-100 opacity-100"
                leave-to-class="transform scale-95 opacity-0"
            >
                <MenuItems
                    class="absolute right-0 z-50 mt-2 w-56 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'shyk-blue text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <GlobeEuropeAfricaIcon
                                    :active="active"
                                    class="shyk-blue mr-2 h-5 w-5"
                                    aria-hidden="true"
                                />
                                Entdecken!
                            </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'bg-violet-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <InformationCircleIcon
                                    :active="active"
                                    class="shyk-blue mr-2 h-5 w-5"
                                    aria-hidden="true"
                                />
                                Hilfe
                            </button>
                        </MenuItem>
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'bg-violet-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <QuestionMarkCircleIcon
                                    :active="active"
                                    class="shyk-blue mr-2 h-5 w-5"
                                    aria-hidden="true"
                                />
                                FAQ
                            </button>
                        </MenuItem>
                    </div>
                    <div class="px-1 py-1">
                        <MenuItem v-slot="{ active }">
                            <button
                                :class="[
                                    active
                                        ? 'bg-violet-500 text-white'
                                        : 'text-gray-900',
                                    'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                                ]"
                            >
                                <MagnifyingGlassIcon
                                    :active="active"
                                    class="shyk-blue mr-2 h-5 w-5"
                                    aria-hidden="true"
                                />
                                Suchen
                            </button>
                        </MenuItem>
                    </div>
                </MenuItems>
            </transition>
        </Menu>
    </div>
</template>
