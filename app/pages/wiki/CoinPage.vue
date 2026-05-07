<template>
    <Head title="Coin - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Coin</h1>

            <h2>Overview</h2>
            <p>
                Coins are the primary currency used by players. They appear in the player's Inventory screen
                and are used for various in-game systems.
            </p>

            <h2>Obtaining Coins</h2>
            <p>
                Players can gain coins in the following ways:
            </p>

            <ul>
                <li>
                    <strong>Monster Drops</strong>
                    <ul>
                        <li>Monsters drop coins when defeated, equal to their level ×10.</li>
                        <li>
                            For example:
                            <ul>
                                <li>A Level 1 monster drops 10 coins.</li>
                                <li>A Level 50 monster drops 500 coins.</li>
                                <li>A Level 120 monster drops 1200 coins.</li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <strong>Selling Items</strong>
                    <ul>
                        <li>Equipment can be sold to NPCs for 250 each.</li>
                        <li>Found artifacts can be sold for 100 each.</li>
                    </ul>
                </li>
                <li>
                    <strong>Trading with other players</strong>
                    <ul>
                        <li>Coins can be exchanged directly with another player through the trade system.</li>
                    </ul>
                </li>
            </ul>

            <h2>Usage</h2>
            <p>
                Coins are currently only used for the process of refining equipment or removing cards from equipment.
                Future updates may expand their use in additional game systems, requiring coins for more activities
                and services.
            </p>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
import WikiLayout from '@/Layouts/WikiLayout.vue';
</script>

<style scoped>

</style>