<template>
    <span
        class="bg-gray-700 text-blue-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-blue-400"
        v-if="color === 'blue'"
    >
        <slot></slot>
    </span>
    <span
        class="bg-gray-700 text-red-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-red-400"
        v-else-if="color === 'red'"
    >
        <slot></slot>
    </span>
    <span
        class="bg-gray-700 text-green-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-green-400"
        v-else-if="color === 'green'"
    >
        <slot></slot>
    </span>
    <span
        class="bg-gray-700 text-yellow-300 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-yellow-300"
        v-else-if="color === 'yellow'"
    >
        <slot></slot>
    </span>
    <span
        class="bg-gray-700 text-gray-400 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm border border-gray-500"
        v-else
    >
        <slot></slot>
    </span>
</template>

<script setup lang="ts">
import { ref } from 'vue';

const props = defineProps<{
    color?: 'default' | 'yellow' | 'green' | 'red' | 'blue';
}>();

const color = ref(props.color ?? 'default');
</script>

<style scoped></style>
