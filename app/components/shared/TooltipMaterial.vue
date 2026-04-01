<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    loading="lazy"
                    :src="'https://spiritvale.info/content/game/icons/item-' + material.icon + '.webp'"
                    :alt="material.DisplayName"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div>
                    <span
                        class="text-xl font-bold"
                        style="color: #ffe100"
                        >Material</span
                    >
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: white"
                        >{{ material.DisplayName }}</span
                    >
                </div>
            </div>
        </div>

        <div class="mt-2 font-bold">
            <div>{{ material.Description }}</div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Material } from '@/types';

defineProps<{
    material: Material;
}>();
</script>

<style scoped></style>
