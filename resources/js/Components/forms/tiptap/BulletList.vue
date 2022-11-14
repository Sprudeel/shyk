<script setup>
import { computed } from "vue";

const props = defineProps(["active"]);

const classes = computed(() => (props.active ? "#000000" : "#95A4A6"));
</script>

<template>
    <span title="Punktliste"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            width="24"
            height="24"
        >
            <path fill="none" d="M0 0h24v24H0z" />
            <path
                d="M8 4h13v2H8V4zm-5-.5h3v3H3v-3zm0 7h3v3H3v-3zm0 7h3v3H3v-3zM8 11h13v2H8v-2zm0 7h13v2H8v-2z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
