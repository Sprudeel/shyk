<script setup>
import { computed } from "vue";

const props = defineProps(["active"]);

const classes = computed(() => (props.active ? "#000000" : "#95A4A6"));
</script>

<template>
    <span title="Fett"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            width="20"
            height="20"
        >
            <path fill="none" d="M0 0h24v24H0z" />
            <path
                d="M8 11h4.5a2.5 2.5 0 1 0 0-5H8v5zm10 4.5a4.5 4.5 0 0 1-4.5 4.5H6V4h6.5a4.5 4.5 0 0 1 3.256 7.606A4.498 4.498 0 0 1 18 15.5zM8 13v5h5.5a2.5 2.5 0 1 0 0-5H8z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
