<template>
    <BaseLayout>
        <Head :title="monster.DisplayName + ' - SpiritVale Info'"></Head>

        <h1 class="page-title">{{ monster.DisplayName }}</h1>
        <div class="visible-tooltip">
            <TooltipMonster
                :monster="monster"
                :key="monster.GameId"
            ></TooltipMonster>
        </div>

        <div
            class="mt-8"
            v-if="spawner"
        >
            <h2>Spawned By</h2>
            <div
                class="visible-tooltip"
                style="cursor: pointer"
                @click="router.get('/consumables/' + spawner.Slug)"
            >
                <TooltipConsumable :consumable="spawner"></TooltipConsumable>
            </div>
        </div>

        <h2 style="margin-top: 3rem">Drops</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 1rem">
            <template
                v-for="drop in monsterDrops"
                :key="drop.slug"
            >
                <div
                    class="visible-tooltip"
                    style="width: 390px; cursor: pointer"
                    v-if="drop.type === 'equipment' && drop.item !== null"
                    @click="router.get('/equipment/' + drop.slug)"
                >
                    <TooltipEquipment :equipment="drop.item"></TooltipEquipment>
                </div>
                <div
                    class="visible-tooltip"
                    style="width: 390px; cursor: pointer"
                    v-if="drop.type === 'card' && drop.item !== null"
                    @click="router.get('/cards/' + drop.slug)"
                >
                    <TooltipCard :card="drop.item"></TooltipCard>
                </div>
                <div
                    class="visible-tooltip"
                    style="width: 390px; cursor: pointer"
                    v-if="drop.type === 'material' && drop.item !== null"
                    @click="router.get('/materials/' + drop.slug)"
                >
                    <TooltipMaterial :material="drop.item"></TooltipMaterial>
                </div>
                <div
                    class="visible-tooltip"
                    style="width: 390px; cursor: pointer"
                    v-if="drop.type === 'consumable' && drop.item !== null"
                    @click="router.get('/consumables/' + drop.slug)"
                >
                    <TooltipConsumable :consumable="drop.item"></TooltipConsumable>
                </div>
                <div
                    class="visible-tooltip"
                    style="width: 390px; cursor: pointer"
                    v-if="drop.type === 'gem' && drop.item !== null"
                    @click="router.get('/gems/' + drop.slug)"
                >
                    <TooltipGem :gem="drop.item"></TooltipGem>
                </div>
            </template>
        </div>

        <h2 style="margin-top: 3rem">Locations</h2>
        <ul>
            <li v-for="location in locations">
                <Link :href="'/maps/' + location.slug">{{ location.name }}</Link>
            </li>
        </ul>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { Card, Consumable, Monster } from '@/types';
import TooltipCard from '@/components/shared/TooltipCard.vue';
import TooltipMonster from '@/components/shared/TooltipMonster.vue';
import TooltipEquipment from '@/components/shared/TooltipEquipment.vue';
import TooltipMaterial from '@/components/shared/TooltipMaterial.vue';
import TooltipConsumable from '@/components/shared/TooltipConsumable.vue';
import TooltipGem from '@/components/shared/TooltipGem.vue';

const props = defineProps<{
    monster: Monster;
    spawner: Consumable | null;
    locations: Array<{ name: string; slug: string }>;
    gameData: any;
}>();

const monsterDrops = [];
props.monster.drops.forEach((drop) => {
    const item = props.gameData[drop.type].find((d) => d.GameId === drop.id);
    monsterDrops.push({ ...drop, item });
});
</script>

<style scoped></style>
