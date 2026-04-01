<template>
    <BaseLayout>
        <Head :title="equipment.DisplayName + ' - SpiritVale Info'"></Head>

        <h1 clasS="page-title">{{ equipment.DisplayName }}</h1>

        <div class="visible-tooltip">
            <TooltipEquipment
                :equipment="equipment"
                :show="true"
            ></TooltipEquipment>
        </div>

        <div
            class="mt-8"
            v-if="equipment.drops.length > 0"
        >
            <h2>Dropped By</h2>
            <ul>
                <li
                    v-for="drop in equipment.drops"
                    :key="drop.monster.name"
                >
                    <Link :href="'/monsters/' + drop.monster.slug">{{ drop.monster.name }}</Link> ({{ drop.chance }}%)
                </li>
            </ul>
        </div>
        <div
            class="mt-8"
            v-if="equipment.crafting !== null"
        >
            <h2>Crafting</h2>
            <div v-if="equipment.crafting.map !== null">
                Crafted in
                <Link :href="'/maps/' + equipment.crafting.map.Slug">{{ equipment.crafting.map.DisplayName }}</Link> (Lv
                {{ equipment.crafting.map.MonsterMinLevel }} - {{ equipment.crafting.map.MonsterMaxLevel }})
            </div>
            <div
                v-for="material in equipment.crafting.materials"
                :key="material.Slug"
            >
                {{ material.count }} x
                <Link :href="'/materials/' + material.item.Slug">{{ material.item.DisplayName }}</Link>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Equipment } from '@/types';
import TooltipEquipment from '@/components/shared/TooltipEquipment.vue';

defineProps<{
    equipment: Equipment;
}>();
</script>

<style scoped></style>
