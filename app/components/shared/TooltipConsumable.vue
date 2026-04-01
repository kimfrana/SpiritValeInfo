<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    loading="lazy"
                    :src="'https://spiritvale.info/content/game/icons/item-' + consumable.icon + '.webp'"
                    :alt="consumable.DisplayName"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div>
                    <span
                        class="text-xl font-bold"
                        style="color: #ffe100"
                        >Consumable</span
                    >
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: white"
                        >{{ consumable.DisplayName }}</span
                    >
                </div>
            </div>
        </div>

        <div class="mt-2 font-bold">
            <div>{{ consumable.Description }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Consumable } from '@/types';

defineProps<{
    consumable: Consumable;
}>();
</script>

<style scoped></style>
