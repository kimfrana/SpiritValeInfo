<template>
    <Head title="Items - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Items</h1>

            <h2>Overview</h2>
            <p>
                Items are the various objects players can acquire and use throughout their journey in SpiritVale.
                They are essential to progression, ranging from gear and consumables to enhancement systems and
                collectible upgrades. This page serves as an overview hub for all item-related categories.
            </p>

            <h2>Consumables</h2>
            <p>
                Consumables are usable items that provide immediate benefits such as travel, summoning, or
                utility effects.
            </p>
            <p><strong>See also: </strong><Link href="/wiki/Consumables">Consumables</Link></p>

            <h2>Materials</h2>
            <p>
                Materials are items used primarily for <Link href="/wiki/Crafting_System">Crafting</Link> and
                <Link href="/wiki/Refinement_System">Refinement</Link>. They form the backbone of upgrading
                and creating new equipment.
            </p>
            <p><strong>See also: </strong><Link href="/wiki/Materials">Materials</Link></p>

            <h2>Equipment</h2>
            <p>
                Equipment includes all wearable and wieldable items such as weapons, armor, and accessories.
                These define a character’s core stats and performance in combat.
            </p>
            <p><strong>See also: </strong><Link href="/wiki/Equipment">Equipment</Link></p>

            <h2>Artifacts</h2>
            <p>
                Artifacts are unique items worn in special slots that provide powerful passive bonuses and set
                effects, offering new ways to enhance builds.
            </p>
            <p><strong>See also: </strong><Link href="/wiki/Artifacts">Artifacts</Link></p>

            <h2>Cards</h2>
            <p>
                Cards are collectible enhancements that can be socketed into most equipment to grant specialized
                bonuses, making them a core system for customization.
            </p>
            <p><strong>See also: </strong><Link href="/wiki/Card_System">Cards</Link></p>
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