<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    loading="lazy"
                    :src="'https://spiritvale.info/content/game/icons/item-' + equipment.icon + '.webp'"
                    :alt="equipment.DisplayName"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div>
                    <span
                        class="text-xl font-bold"
                        style="color: #ffe100"
                        >{{ equipment.typeName }}</span
                    >
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: white"
                        >{{ equipment.DisplayName }}</span
                    >
                </div>
            </div>
        </div>

        <div class="mt-2 font-bold">
            <div>{{ equipment.Description }}</div>

            <div class="mt-2">
                <div
                    v-for="stat in equipment.statsPrimary"
                    v-html="fixColor(stat)"
                ></div>
                <div v-if="equipment.statsPrimary.length > 0 && equipment.statsSecondary.length > 0">
                    ----------------
                </div>
                <div
                    v-for="stat in equipment.statsSecondary"
                    v-html="fixColor(stat)"
                ></div>
            </div>
        </div>

        <div
            class="mt-4 font-bold"
            v-if="equipment.Slots > 0"
        >
            {{ equipment.Slots }} Card Slot<span v-if="equipment.Slots > 1">s</span>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Equipment } from '@/types';

defineProps<{
    equipment: Equipment;
    show?: boolean;
}>();

const fixColor = (statLine: string) => {
    let n = statLine.replace('font-weight: bold; color: green', 'font-weight: bold; color: #a6f70c');
    n = n.replace('font-weight: bold; color: red', 'font-weight: bold; color: #ff5151');
    return n;
};
</script>

<style scoped></style>
