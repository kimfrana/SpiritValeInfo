<template>
    <Head title="Monsters - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Monsters</h1>

            <h2>Overview</h2>
            <p>
                Monsters are the primary enemies that players encounter throughout the world. They can be found
                on specific maps, and their type, strength, and abilities vary greatly depending on location.
            </p>
            <ul>
                <li>
                    Monsters can be either <strong>Passive</strong> (do not attack unless attacked) or
                    <strong>Aggressive</strong> (attack the player on sight).
                </li>
                <li>
                    They can have any of the nine <a href="/wiki/Elements">Elements</a> which determines
                    their strengths and weaknesses in combat.
                </li>
                <li>
                    Their basic stats, as well as some sub stats (such as critical chance, accuracy, and defense),
                    are visible when inspecting them.
                </li>
                <li>
                    Players can inspect any monster by hovering over it and pressing F. This reveals its stats,
                    health pool, element, and loot table.
                </li>
                <li>
                    Each monster has its own loot table, including item drop chances, viewable both
                    in-game and on the database.
                </li>
            </ul>

            <h2>Normal Monsters</h2>
            <p>
                Normal monsters are the most common enemies found in the game and make up the majority
                of encounters across maps.
            </p>
            <ul>
                <li>They respawn quickly across the map.</li>
                <li>
                    Some monsters can appear in a larger Giant form, which is accompanied by up to
                    five smaller minion monsters.
                </li>
                <li>
                    They use a variety of skills, similar to player classes.
                </li>
                <li>
                    Defeating normal monsters is a common source of experience, crafting materials,
                    equipment, and card drops.
                </li>
            </ul>

            <h2>Boss Monsters</h2>
            <p>
                Boss monsters are unique, powerful creatures that serve as major challenges within each map.
            </p>
            <ul>
                <li>Bosses are one-of-a-kind and do not respawn as frequently as normal monsters.</li>
                <li>
                    They usually respawn every <strong>2–3 hours</strong>, or can be summoned using a
                    <strong>Boss Lure</strong>.
                </li>
                <li>Bosses have much greater amounts of health and deal significantly more damage than normal monsters.</li>
                <li>They use powerful skills that can incapacitate or even kill an unprepared player.</li>
                <li>
                    Bosses often drop the best loot available in their respective maps, including rare equipment,
                    artifacts, and exclusive monster cards.
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