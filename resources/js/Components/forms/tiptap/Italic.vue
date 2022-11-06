<script setup>
import { computed } from "vue";

const props = defineProps(["active"]);

const classes = computed(() => (props.active ? "#000000" : "#95A4A6"));
</script>

<template>
    <span title="Kursiv"
        ><svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 20 20"
            width="20"
            height="20"
        >
            <path fill="none" d="M0 0h24v24H0z" />
            <path
                d="M15 20H7v-2h2.927l2.116-12H9V4h8v2h-2.927l-2.116 12H15z"
                :fill="classes"
            />
        </svg>
    </span>
</template>
