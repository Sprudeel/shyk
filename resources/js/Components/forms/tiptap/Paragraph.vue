<script setup>
import { computed } from "vue";

const props = defineProps(["active"]);

const classes = computed(() => (props.active ? "#000000" : "#95A4A6"));
</script>

<template>
    <span title="Text"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            width="20"
            height="20"
        >
            <path fill="none" d="M0 0h24v24H0z" />
            <path
                d="M12 6v15h-2v-5a6 6 0 1 1 0-12h10v2h-3v15h-2V6h-3zm-2 0a4 4 0 1 0 0 8V6z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
