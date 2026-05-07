<template>
    <Head title="Skills - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Skills</h1>

            <h2>Overview</h2>
            <p>
                Skills are the abilities of both monsters and players that take action in the world.
                From the Wizard’s mighty elemental spells to the Death Mage’s powerful Dark Exorcism,
                these are the main abilities of combat.
            </p>
            <p>
                There are two main types of skills in SpiritVale. The first type is Player Skills,
                which are the abilities that players use in combat. The second type is Monster Skills,
                which are abilities used by enemies throughout the world.
            </p>

            <h2>Player Skills</h2>
            <p>
                Player skills are granted through base and advanced <a href="/wiki/Classes">Classes</a>,
                as well as through special items and cards.
            </p>
            <h3>Class Skills</h3>
            <p>
                Each class has its own set of unique active and passive abilities. See the individual class
                pages for full skill lists, descriptions, and scaling.
            </p>
            <h3>Item and Card Granted Skills</h3>
            <p>
                Some items and cards grant players access to additional abilities.
            </p>
            <ul>
                <li>Class Skills: These are temporary or alternative ways to use abilities from another class.</li>
                <li>
                    Unique Skills: These are special abilities not tied to any class, and they are available only
                    through items or cards.
                </li>
            </ul>
            <p>These skills can expand build options and provide powerful situational abilities.</p>

            <h2>Monster Skills</h2>
            <p>
                Monsters also have access to skills. Some are the same as player skills, while others
                are unique abilities that only monsters can use.
            </p>
            <p>
                Monster skills determine how encounters play out. They range from basic attacks to
                devastating area effects.
            </p>
            <h3>Breakdown</h3>
            <ul>
                <li>Some monster skills are shared with players, such as Fireball.</li>
                <li>Some are unique to monsters, such as Berserk used by stronger monsters.</li>
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