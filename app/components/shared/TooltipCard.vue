<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    :src="'https://spiritvale.info/content/game/icons/' + card.icon + '.webp'"
                    :alt="card.DisplayName"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div>
                    <span
                        class="text-xl font-bold"
                        style="color: #ffe100"
                        >Card</span
                    >
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: white"
                        >{{ card.DisplayName }}</span
                    >
                </div>
                <div>
                    <span
                        class="text mt-2 font-bold"
                        style="color: white"
                        >Affix: {{ card.Affix }}</span
                    >
                </div>
            </div>
        </div>

        <div>{{ card.Description }}</div>

        <div class="mt-3">
            <span
                class="text-lg font-bold"
                style="color: #ffe100"
                >{{ card.slot }} Card</span
            >
        </div>
        <div
            v-for="stat in card.stats"
            v-html="stat"
        ></div>
    </div>
</template>

<script setup lang="ts">
import { Card } from '@/types';

defineProps<{
    card: Card;
    show?: boolean;
}>();
</script>

<style scoped></style>
