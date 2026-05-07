<template>
    <Head title="Arena - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Arena</h1>

            <p>
                The Arena is the current form of player-versus-player (PvP) content in the game. It is a wide,
                open map designed for free-for-all combat between players, with unique rules applied
                to balance gameplay.
            </p>

            <h2>Getting There</h2>
            <ul>
                <li>The Arena entrance is located in Nevaris, near the Healer NPC.</li>
                <li>Players can freely enter and exit. There are five exits in the Arena that all return to Nevaris.</li>
            </ul>

            <h2>points of Interest</h2>
            <h3>Map Entrances</h3>
            <p>The Arena contains five entrances that all lead back to Nevaris.</p>
            <h3>Landmarks</h3>
            <p>The Arena itself is a large, open combat zone with no internal structures or NPCs.</p>

            <h2>Gameplay Rules</h2>
            <p>The Arena modifies several systems to create a balanced PvP environment:</p>
            <ul>
                <li>All player levels are set to <strong>100</strong> while inside the Arena.</li>
                <li>All damage and healing are reduced by <strong>75%</strong>.</li>
                <li>HP regeneration is reduced by <strong>75%</strong>.</li>
                <li>Summoned creatures do not function within the Arena.</li>
            </ul>

            <h2>Tips &amp; Trivia</h2>
            <ul>
                <li>Because all exits lead back to Nevaris, players can quickly rejoin city services after combat.</li>
                <li>The Arena is often used to test builds and strategies against other players in real-time conditions.</li>
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