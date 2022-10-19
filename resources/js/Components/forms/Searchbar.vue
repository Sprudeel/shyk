<script>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";

export default {
    components: { MagnifyingGlassIcon },
};
</script>

<template>
    <div
        class="ml-8 inline-flex items-center justify-center rounded-md border bg-gray-200 p-1 pl-2"
    >
        <label for="searchinput">
            <MagnifyingGlassIcon class="h-5 w-5 text-gray-500" />
        </label>
        <input
            id="searchinput"
            class="ml-2 mr-1 w-36 border-none bg-gray-200 text-xs text-gray-500 outline-none duration-150 focus:w-48 o-md:w-24"
            placeholder="Suchen..."
        />
    </div>
</template>
