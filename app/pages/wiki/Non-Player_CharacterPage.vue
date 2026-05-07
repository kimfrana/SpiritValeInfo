<template>
    <Head title="Non-Player Character - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Non-Player Character</h1>

            <h2>Overview</h2>
            <p>
                Non-Player Characters, commonly referred to as NPCs, are in-game persons you can meet throughout
                the world. They provide different levels of information, services, and progression options depending
                on their type.
            </p>

            <h2>Types of NPCs</h2>
            <p>At present, there are three main types of NPCs:</p>

            <h3>Townfolks</h3>
            <p>
                Townsfolk are found in <a href="/maps/nevaris">Nevaris</a>. They provide essential services such as:
            </p>
            <ul>
                <li>Healing</li>
                <li>Resetting attributes and skills</li>
                <li>Refinement of equipment</li>
            </ul>

            <h3>Craftsmen</h3>
            <p>
                <a href="/wiki/Crafting_System">Craftsmen</a> are scattered across the world, often located near
                the Map's <a href="/wiki/Waypoints">Waypoint</a>. They specialize in crafting and will create
                equipment or items if you bring the required materials from their respective maps.
            </p>

            <h3>Class Masters</h3>
            <p>
                Class Masters oversee the advancement of adventurers. They guide players wishing to transition
                from their base class into one of their advanced classes. Each base class has its own dedicated
                set of Class Masters.
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