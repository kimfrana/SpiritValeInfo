<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    :src="'https://spiritvale.info/content/game/icons/' + gem.icon + '.webp'"
                    :alt="gem.DisplayName"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div>
                    <span
                        class="text-xl font-bold"
                        style="color: #ffe100"
                        ><span v-if="gem.IsBoss">Boss</span><span v-else>Skill</span> Gem</span
                    >
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: white"
                        >{{ gem.DisplayName }}</span
                    >
                </div>
                <div>
                    <span
                        class="text mt-2 font-bold"
                        style="color: white"
                        >Affix: {{ gem.Affix }}</span
                    >
                </div>
            </div>
        </div>

        <div>{{ gem.Description }}</div>

        <div
            v-for="stat in gem.statsTexts"
            v-html="stat"
        ></div>
    </div>
</template>

<script setup lang="ts">
import { Gem } from '@/types';

defineProps<{
    gem: Gem;
    show?: boolean;
}>();
</script>

<style scoped></style>
