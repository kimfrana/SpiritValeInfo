<template>
    <Head title="Dodge Roll - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Dodge Roll</h1>

            <p>
                The dodge roll mechanic (default key: Space) lets you move quickly and avoid damage.
                A yellow bar under your HP/MP shows the cooldown.
            </p>

            <h2>Basics</h2>
            <ul>
                <li>Press <strong>Space</strong> to roll.</li>
                <li><strong>Cooldown</strong>: 2 seconds (watch the yellow bar).</li>
                <li>
                    <strong>Invulnerability</strong>: You are immune for 0.5 seconds from the start of the roll.
                    During this time you ignore all damage, ground AoEs, targeted skills, and debuffs.
                </li>
            </ul>

            <h2>How to Aim Your Roll</h2>
            <ul>
                <li>You always roll <strong>forward</strong> from your character’s currently facing direction.</li>
                <li>
                    To change the direction of your roll: <strong>hold W/A/S/D first</strong>, then press Space.
                    <ul>
                        <li>Or <strong>click</strong> to face a direction, then press Space.</li>
                    </ul>
                </li>
                <li>You cannot turn mid-roll.</li>
            </ul>

            <h2>Timing</h2>
            <ul>
                <li>The 0.5 s immunity window is generous, and perfect timing isn’t needed.</li>
                <li>Start the roll just before the danger hits (physical attack, projectile, or spell targeting).</li>
                <li>
                    You can roll through many hazards as your i-frames during the 0.5 seconds cover the
                    damage or affects applied during that time.
                </li>
            </ul>

            <h2>Tips</h2>
            <ul>
                <li>Pre-hold your movement key, then press Space as this gives precise control.</li>
                <li>Don’t spam the roll. Save it for big hits or dangerous ground effects.</li>
                <li>After the roll, reposition quickly as your immunity ends fast.</li>
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