<template>
    <Head title="Item Storage - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Item Storage</h1>

            <h2>Overview</h2>
            <p>
                Item Storage is how the game manages and organizes the various items players receive during
                gameplay. Storage is divided into two major systems: Player-held Storage and Bank-held Storage.
                Both systems allow items to be browsed, filtered, and searched.
            </p>

            <h2>Types of Storage</h2>
            <h3>Player-held Storage</h3>
            <ul>
                <li>Items are carried directly on the character.</li>
                <li>Has a base <strong>2000 weight limit</strong>.</li>
                <li>This weight limit increases by <strong>+30 per base level</strong>.</li>
                <li>
                    There are a maximum of <strong>150 base levels</strong>, allowing for a total of 6000
                    weight at the maximum level.
                </li>
            </ul>

            <h2>Bank-held Storage</h2>
            <ul>
                <li>Items are stored in the bank, accessible in <a href="/maps/nevaris">Nevaris</a>.</li>
                <li>There is <strong>no weight limit</strong>.</li>
                <li>
                    Instead, there is a <strong>1000 unique item limit</strong>.
                    <ul>
                        <li>
                            Stacking items only count as one slot. For example, a stack of 100
                            <a href="/materials/lunaris-shard">Lunaris Shards</a> is considered a single unique item.
                        </li>
                    </ul>
                </li>
            </ul>

            <h2>Inventory Tabs</h2>
            <p>Both storage systems sort items into five separate tabs, making it easier to locate items quickly:</p>
            <ul>
                <li>Consumables — Items that can be used such as the Waystone and Boss Lures.</li>
                <li>Equipment — Weapons, armor, and accessories worn by the player.</li>
                <li>Artifacts — All artifact equipment.</li>
                <li>Cards — The various cards found throughout the world.</li>
                <li>Materials — Items used for crafting, refining, and other processes.</li>
            </ul>

            <h2>Search Function</h2>
            <p>Both Player and Bank storage include a built-in search feature:</p>
            <ul>
                <li>Searches are limited to the currently selected tab.</li>
                <li>Searches match against both item names and item descriptions.</li>
                <li>
                    Example: entering "STR" will display all items that reference Strength
                    in their name or description.
                </li>
            </ul>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
import WikiLayout from '@/Layouts/WikiLayout.vue';
</script>

<style scoped>

</style>