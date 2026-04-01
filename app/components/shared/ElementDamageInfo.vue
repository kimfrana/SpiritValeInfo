<template>
    <div
        class="text-lg"
        v-if="element === 'Earth'"
    >
        (<ElementLabel element="Fire"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Wind"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Earth"></ElementLabel>: <strong style="color: red">x0.5</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Fire'"
    >
        (<ElementLabel element="Fire"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Water"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Earth"></ElementLabel>: <strong style="color: red">x0.75</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Holy'"
    >
        (<ElementLabel element="Poison"></ElementLabel>: <strong style="color: red">x0.75</strong>
        <ElementLabel element="Shadow"></ElementLabel>: <strong style="color: green">x1.25</strong>
        <ElementLabel element="Holy"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Undead"></ElementLabel>: <strong style="color: red">x0.75</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Neutral'"
    >
        (<ElementLabel element="Poison"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Shadow"></ElementLabel>: <strong style="color: green">x1.25</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Poison'"
    >
        (<ElementLabel element="Neutral"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Poison"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Holy"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Undead"></ElementLabel>: <strong style="color: green">x1.25</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Shadow'"
    >
        (<ElementLabel element="Neutral"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Shadow"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Holy"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Undead"></ElementLabel>: <strong style="color: red">x0.75</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Water'"
    >
        (<ElementLabel element="Fire"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Water"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Wind"></ElementLabel>: <strong style="color: green">x1.25</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Wind'"
    >
        (<ElementLabel element="Water"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Wind"></ElementLabel>: <strong style="color: red">x0.5</strong>,
        <ElementLabel element="Earth"></ElementLabel>: <strong style="color: green">x1.25</strong>)
    </div>
    <div
        class="text-lg"
        v-else-if="element === 'Undead'"
    >
        (<ElementLabel element="Poison"></ElementLabel>: <strong style="color: red">x0.75</strong>,
        <ElementLabel element="Shadow"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Holy"></ElementLabel>: <strong style="color: green">x1.25</strong>,
        <ElementLabel element="Undead"></ElementLabel>: <strong style="color: red">x0.5</strong>)
    </div>
    <div v-else>?</div>
</template>

<script setup lang="ts">
import { GameElement } from '@/types';
import ElementLabel from '@/components/shared/ElementLabel.vue';

defineProps<{
    element: GameElement;
}>();
</script>

<style scoped></style>
