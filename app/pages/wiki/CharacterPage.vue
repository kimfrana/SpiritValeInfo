<template>
    <Head title="Character - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Character</h1>

            <p>
                The <strong>Character</strong> page contains information about the systems that define and support
                a player’s character in SpiritVale.
            </p>

            <h2>Classes</h2>
            <p>
                Classes define a character’s role in combat and progression. They determine which skills can be
                learned, what weapons are most effective, and how a character interacts with the world.
            </p>
            <p>See: <Link href="/wiki/Classes">Classes</Link></p>

            <h2>Attributes</h2>
            <p>
                The foundation of character growth. Attributes determine stats such as Attack, Defence, HP,
                and more, shaping combat performance and progression.
            </p>
            <p>See: <Link href="/wiki/Attributes">Attributes</Link></p>

            <h2>Skills</h2>
            <p>
                The abilities used in combat by both players and monsters. Includes class-specific skills,
                item and card-granted skills, and monster-only abilities.
            </p>
            <p>See: <Link href="/wiki/Skills">Skills</Link></p>

            <h2>Storage</h2>
            <p>
                How items are managed throughout the game. Explains the differences between player inventory
                and bank storage, including limits, tabs, and search functions.
            </p>
            <p>See: <Link href="/wiki/Storage">Storage</Link></p>

            <h2>Coin</h2>
            <p>
                The main currency of the game. Covers how coins are obtained, their uses in the Refinement
                system, and their role in trading.
            </p>
            <p>See: <Link href="/wiki/Coin">Coin</Link></p>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import WikiLayout from '@/Layouts/WikiLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<style scoped>

</style>