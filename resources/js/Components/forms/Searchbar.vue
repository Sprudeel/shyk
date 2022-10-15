<script>
import { MagnifyingGlassIcon } from "@heroicons/vue/24/solid";

export default {
  components: { MagnifyingGlassIcon },
};
</script>

<template>
  <div
    class="ml-8 flex items-center justify-center rounded-md border bg-gray-200 p-2"
  >
    <label for="searchinput">
      <MagnifyingGlassIcon class="h-5 w-5 text-gray-500" />
    </label>
    <input
      id="searchinput"
      class="ml-2 mr-1 w-36 border-none bg-gray-200 text-xs text-gray-500 outline-none focus:w-48 transform duration-150 forwards"
      placeholder="Suchen..."
    />
  </div>
</template>
