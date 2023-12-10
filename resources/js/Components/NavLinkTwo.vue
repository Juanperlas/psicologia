<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
    props.active
        ? "flex items-end justify-center text-center mx-auto px-4 pt-2 w-full text-blue-500 border-b-2 border-blue-500 font-bold"
        : "flex items-end justify-center text-center text-black mx-auto px-4 pt-2 w-full group-hover:text-gray-100 border-b-2 border-transparent hover:bg-blue-400 rounded-xl"
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
