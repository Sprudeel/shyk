<script setup>
import { computed } from "vue";

const props = defineProps(["active"]);

const classes = computed(() => (props.active ? "#000000" : "#95A4A6"));
</script>

<template>
    <span title="grosser Titel"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 25 20"
            width="20"
            height="20"
        >
            <path fill="none" d="M0 0H24V24H0z" />
            <path
                d="M13 20h-2v-7H4v7H2V4h2v7h7V4h2v16zm8-12v12h-2v-9.796l-2 .536V8.67L19.5 8H21z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
