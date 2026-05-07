<template>
    <img :src="'https://spiritvale.info/content/game/icons/element-' + element + '.webp'" style="display: inline; height: 1.2rem;" :alt="element">
    <span
        class="mx-1"
        :style="{ 'font-weight': 'bold', color: getElementColorLight(element) }"
        >{{ element }}</span
    >
</template>

<script setup lang="ts">
import { GameElement } from '@/types';

defineProps<{
    element: GameElement;
}>();

const getElementColorLight = (color: GameElement): string => {
    switch (color) {
        case 'Neutral':
            return '#86807d'; //e4dbce
        case 'Fire':
            return '#ff7026';
        case 'Water':
            return '#24a8dc'; //79d7fd
        case 'Earth':
            return '#bb7b2f';
        case 'Wind':
            return 'oklch(85.2% 0.199 91.936)'; //ffc701
        case 'Poison':
            return '#55bb2e'; //8cd470
        case 'Holy':
            return '#e89ea1'; //fce9eb
        case 'Shadow':
            return '#755e94';
        case 'Undead':
            return '#C85AE0';
        default:
            return 'black';
    }
};
</script>

<style scoped></style>
