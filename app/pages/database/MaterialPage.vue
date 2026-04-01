<template>
    <BaseLayout>
        <Head :title="material.DisplayName + ' - SpiritVale Info'"></Head>

        <h1 clasS="page-title">{{ material.DisplayName }}</h1>

        <div class="visible-tooltip">
            <TooltipMaterial :material="material"></TooltipMaterial>
        </div>

        <div class="mt-8">
            <h2>Dropped By</h2>
            <ul>
                <li
                    v-for="drop in material.drops"
                    :key="drop.monster.name"
                >
                    <Link :href="'/monsters/' + drop.monster.slug">{{ drop.monster.name }}</Link> ({{ drop.chance }}%)
                </li>
            </ul>
        </div>

        <div class="mt-8">
            <h2>Shops</h2>
            <Deferred data="vending">
                <template #fallback>
                    <div>Loading...</div>
                </template>

                <template #default>
                    <div
                        class="mt-4 mb-4"
                        v-for="shop in vending?.shops"
                        :key="shop.characterName"
                    >
                        <div>{{ shop.name }} ({{ shop.characterName }}) [{{ shop.map }} | {{ shop.server }}]</div>
                        <div v-if="shop.itemInfo">
                            {{ shop.itemInfo.count }} x {{ Intl.NumberFormat('en-US').format(shop.itemInfo.price) }}
                        </div>
                    </div>
                </template>
            </Deferred>
        </div>

        <div class="mt-8">
            <h2>Vending History</h2>
            <Deferred data="vendingHistory">
                <template #fallback>
                    <div>Loading...</div>
                </template>
                <template #default>
                    <div
                        class="mt-4 mb-4"
                        v-for="entry in vendingHistory"
                        :key="entry.sellTime"
                    >
                        {{ entry.count }} x {{ Intl.NumberFormat('en-US').format(entry.price) }} ({{
                            entry.sellTime.substr(0, 10)
                        }})
                    </div>
                </template>
            </Deferred>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Deferred, Head, Link } from '@inertiajs/vue3';
import { Consumable } from '@/types';
import TooltipMaterial from '@/components/shared/TooltipMaterial.vue';

defineProps<{
    material: Consumable;
    vending?: {
        shops: Array<{
            name: string;
            server: string;
            map: string;
            characterName: string;
            itemInfo: null | { count: number; price: number };
        }>;
        cardsSold: Array<{ name: string; count: number }>;
    };
    vendingHistory?: Array<{ count: number; price: number; sellTime: string; refine: null | number }>;
}>();
</script>

<style scoped></style>
