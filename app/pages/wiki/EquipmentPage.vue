<template>
    <Head title="Equipment - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Equipment</h1>

            <h2>Equipment Types</h2>
            <p>
                Equipment is divided into multiple categories. Each serves a different role, whether for offense,
                defense, or utility.
            </p>
            <ul>
                <li>Accessory</li>
                <li>Axe</li>
                <li>Book</li>
                <li>Chest (armor)</li>
                <li>Dagger</li>
                <li>Face</li>
                <li>Headgear</li>
                <li>Legwear</li>
                <li>Mace</li>
                <li>Ranged (bows, guns, crossbows, etc.)</li>
                <li>Shield</li>
                <li>Shoes</li>
                <li>Spear</li>
                <li>Staff</li>
                <li>Sword</li>
                <li>Utility</li>
            </ul>

            <h2>Primary Stats</h2>
            <p>
                Primary stats are based on the weapon type (Atk, Matk) for weapons, Block for shields, Move Spd for
                Shoes and Def, Mdef, Flee, Hp, Mp, Hp Regen, Mp Regen for armor in general. Many of the primary
                stats scale with the refine level of the equipment.
            </p>

            <h2>Secondary Stats</h2>
            <p>
                Secondary stats are fixed for every specific piece of equipment but cover a larger range of
                different effects including resistance to elements and skill damage. Unless explicitly stated
                they do not scale with the refine level.
            </p>

            <h2>Bonus Stats</h2>
            <p>
                Bonus stats are random rolls on equipment. Both the type of the stat and the value are random
                based on a group of possible stats.
            </p>
            <p><strong>TODO</strong></p>
            <p>
                Each row represents a possible random modifier. Flat (+) adds a fixed amount; Multiplier scales
                with your current value. Negative values (–) represent reductions, such as damage taken or MP cost.
            </p>
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