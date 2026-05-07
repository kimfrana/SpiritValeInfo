<template>
    <Head title="Consumables - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Consumables</h1>

            <h2>Overview</h2>
            <p>
                Consumables are items that are used up when activated, typically providing travel, summoning, or
                utility effects. They appear in the Consumables tab of the player's Inventory.
            </p>

            <h3>Waystone</h3>
            <p>
                The Waystone allows players to return instantly to Nevaris from any location. It is one of the
                most commonly used consumables, providing a fast method of returning to the town hub. Unlike most
                consumables, it is not consumed when used.
            </p>

            <h3>Boss Lure</h3>
            <p>
                Boss lures are special consumables that summon bosses in their respective maps, provided the boss
                is not already alive.
            </p>
            <ul>
                <li><GameDataLink type="consumable" slug="gnawed-acorn" /> — summons <GameDataLink type="monster" slug="hare" /></li>
            </ul>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import WikiLayout from '@/Layouts/WikiLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import GameDataLink from '@/components/shared/GameDataLink.vue';
</script>

<style scoped>

</style>