<script setup>
import { computed } from "vue";

const props = defineProps(["disabled"]);

const classes = computed(() => (props.disabled ? "#95A4A6" : "#000"));
</script>

<template>
    <span title="Rückgängig"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 22 22"
            width="20"
            height="20"
        >
            <path fill="none" d="M0 0h24v24H0z" />
            <path
                d="M18.172 7H11a6 6 0 1 0 0 12h9v2h-9a8 8 0 1 1 0-16h7.172l-2.536-2.536L17.05 1.05 22 6l-4.95 4.95-1.414-1.414L18.172 7z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
