<template>
    <Head title="Card System - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Card System</h1>

            <h2>Description</h2>
            <p>
                Cards are collectible enhancements that can be inserted into equipment to grant special bonuses.
                Almost every piece of equipment includes at least one slot for cards, making them a core part
                of character progression and customization. Players can mix and match cards to tailor their
                builds for offense, defense, or utility.
            </p>

            <h2>How to Obtain Cards</h2>
            <p>Cards drop from monsters throughout the world.</p>
            <ul>
                <li><strong>Drop Rates:</strong> Most cards have a drop chance between 1% and 3%.</li>
                <li>
                    <strong>Boss Cards:</strong> Powerful boss monsters have unique cards with stronger effects,
                    but these are often the rarest and most sought after.
                </li>
            </ul>

            <h2>Card Socket on Equipment</h2>
            <p>
                Most equipment, including weapons, armor, and accessories, comes with one or more card sockets.
                The number of sockets depends on the item type and rarity.
            </p>
            <ul>
                <li>Weapons typically feature offensive-focused card slots.</li>
                <li>Armor and accessories provide defensive or utility-based slots.</li>
                <li>Artifacts do not have any card slots.</li>
            </ul>

            <h2>Socketing Cards into Equipment</h2>
            <p>
                Players can insert cards into equipment by clicking on the card within their inventory which
                will ask them if they wish to socket that card.
            </p>
            <ul>
                <li>Once placed, the card’s effects are immediately applied to the equipment.</li>
                <li>Equipment only has a certain number of spots available for cards.</li>
            </ul>

            <h2>Removing Cards from Equipment</h2>
            <p>Cards can be removed from equipment by using the card removal merchant in Nevaris.</p>
            <ul>
                <li>
                    Removing a card preserves both the card and the equipment, but costs
                    <Link href="/wiki/Coin">coins</Link>.
                </li>
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