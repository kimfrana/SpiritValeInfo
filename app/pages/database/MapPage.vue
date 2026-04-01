<template>
    <BaseLayout>
        <Head :title="maps[0].DisplayName + ' - SpiritVale Info'"></Head>

        <h1 class="page-title">{{ maps[0].DisplayName }}</h1>

        <h2>Monsters</h2>
        <div
            v-for="map in maps"
            :key="map.GameId"
        >
            <h3
                style="font-size: 1.5rem; margin-top: 1rem"
                v-if="maps.length > 1"
            >
                Area Lv {{ map.MonsterMinLevel }} - {{ map.MonsterMaxLevel }}
            </h3>
            <div style="display: flex; flex-wrap: wrap; gap: 1rem">
                <template
                    v-for="monster in map.monsters"
                    :key="monster.GameId"
                >
                    <div
                        class="visible-tooltip"
                        style="width: 390px"
                    >
                        <TooltipMonster :monster="monster"></TooltipMonster>
                    </div>
                </template>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';
import { GameMap } from '@/types';
import TooltipMonster from '@/components/shared/TooltipMonster.vue';

defineProps<{
    maps: Array<GameMap>;
}>();
</script>

<style scoped></style>
