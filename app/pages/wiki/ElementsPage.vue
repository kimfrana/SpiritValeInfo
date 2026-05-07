<template>
    <Head title="Elements - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Elements</h1>

            <h2>Overview</h2>
            <p>
                Elements are a core combat system in SpiritVale. Every monster, attack, and the player themselves;
                has an elemental type. Each element has it's own strengths and weaknesses.
            </p>
            <p>
                There are nine elements:
            </p>
            <ul>
                <li><ElementLabel element="Neutral"/></li>
                <li><ElementLabel element="Poison"/></li>
                <li><ElementLabel element="Shadow"/></li>
                <li><ElementLabel element="Holy"/></li>
                <li><ElementLabel element="Undead"/></li>
                <li><ElementLabel element="Earth"/></li>
                <li><ElementLabel element="Fire"/></li>
                <li><ElementLabel element="Water"/></li>
                <li><ElementLabel element="Wind"/></li>
            </ul>
            <p>The default element is Neutral, which represents non-elemental damage.</p>

            <h2>Gameplay Effects</h2>
            <p>
                Elements have a component in that when attacking with an element it may be weaker or
                stronger against an opponent with a different element.
            </p>
            <table class="wiki-data-table">
                <thead>
                <tr>
                    <th>Outcome</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Strong</td>
                    <td>Attacking element deals 125% damage to a defending element it is strong against.</td>
                </tr>
                <tr>
                    <td>Neutral</td>
                    <td>Attacking element deals 100% damage when there is no strength or weakness.</td>
                </tr>
                <tr>
                    <td>Weak</td>
                    <td>Attacking element deals only 75% damage when it is weak against the defending element.</td>
                </tr>
                <tr>
                    <td>Same Element</td>
                    <td>
                        Attacking element deals only 50% damage when used against the same element.<br>
                        <strong>Exception</strong>: Neutral vs Neutral still deals 100% damage.
                    </td>
                </tr>
                </tbody>
            </table>
            <p>
                At the start of the game all players and their physical attacks are Neutral. However, players
                can change from the Neutral element with <strong>Convert Cards</strong>:
            </p>
            <ul>
                <li><strong>Weapon Convert Card</strong> – Converts physical attacks from Neutral to that element.</li>
                <li><strong>Chest Convert Card</strong> – Converts defensive typing from Neutral to that element.</li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Neutral.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Neutral</h2>
            <ul>
                <li><strong>Description:</strong> The default element when none is specified.</li>
                <li><strong>Creatures:</strong> Common early-game enemies.</li>
                <li><strong>Special:</strong> Neutral vs Neutral always deals 100%.</li>
                <li><strong>Strong against (125%):</strong> —</li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Poison"/>, <ElementLabel element="Shadow"/></li>
                <li><strong>Weapon Convert Card:</strong> N/A (default)</li>
                <li><strong>Chest Convert Card:</strong> N/A (default)</li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Poison.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Poison</h2>
            <ul>
                <li><strong>Description:</strong> Venomous damage; can inflict a stacking poison DoT.</li>
                <li><strong>Creatures:</strong> Snakes, spiders, bats, insects.</li>
                <li><strong>Special:</strong> Poison debuff deals damage over time until cleansed or expired.</li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Neutral"/></li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Holy"/>, <ElementLabel element="Undead"/></li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="spider-king-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="worm-creep-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Shadow.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Shadow</h2>
            <ul>
                <li><strong>Description:</strong> Dark magic; often applies ailments.</li>
                <li><strong>Creatures:</strong> Demons, ghosts, horrors.</li>
                <li><strong>Special:</strong> Can inflict status effects (e.g., Silence, Blindness).</li>
                <li>
                    <strong>Strong against (125%):</strong> <ElementLabel element="Neutral"/>,
                    <ElementLabel element="Holy"/>, <ElementLabel element="Undead"/>
                </li>
                <li><strong>Weak against (75%):</strong> —</li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="spider-king-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="spider-king-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Holy.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Holy</h2>
            <ul>
                <li><strong>Description:</strong> Light and purity; counters darkness and undeath.</li>
                <li><strong>Creatures:</strong> Angels, fairies, spiritual beings.</li>
                <li><strong>Special:</strong> Healing effects deal damage to Undead.</li>
                <li>
                    <strong>Strong against (125%):</strong> <ElementLabel element="Poison"/>,
                    <ElementLabel element="Shadow"/>, <ElementLabel element="Undead"/>
                </li>
                <li><strong>Weak against (75%):</strong> —</li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="spider-king-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="spider-king-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Undead.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Undead</h2>
            <ul>
                <li><strong>Description:</strong> Non-living essence; rare element.</li>
                <li><strong>Creatures:</strong> Zombies, skeletons, abominations.</li>
                <li>
                    <strong>Special:</strong> Especially threatened by Holy damage, and takes damage from
                    healing instead of recovering health.
                </li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Poison"/></li>
                <li>
                    <strong>Weak against (75%):</strong> <ElementLabel element="Shadow"/>,
                    <ElementLabel element="Holy"/>
                </li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="zombie-goblin-giant-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="zombie-goblin-lord-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Earth.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Earth</h2>
            <ul>
                <li><strong>Description:</strong> Stone, soil, and flora; sturdy and grounding.</li>
                <li><strong>Creatures:</strong> Goblins, plants, burrowers.</li>
                <li><strong>Special:</strong> Excels against Wind.</li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Wind"/></li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Fire"/></li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="goblin-giant-mage-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="goblin-giant-mage-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Fire.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Fire</h2>
            <ul>
                <li><strong>Description:</strong> Heat, lava, and flame.</li>
                <li><strong>Creatures:</strong> Fire elementals, desert beasts, devils.</li>
                <li><strong>Special:</strong> Burns through Earth-type foes.</li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Earth"/></li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Water"/></li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="dog-bowwow-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="scorpion-king-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Water.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Water</h2>
            <ul>
                <li><strong>Description:</strong>Rivers, lakes, and ice.</li>
                <li><strong>Creatures:</strong> Ocean dwellers, ice creatures, cyclopes.</li>
                <li><strong>Special:</strong> Douses Fire-type foes.</li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Fire"/></li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Wind"/></li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="petal-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="ice-mage-card" /></li>
            </ul>

            <h2><img :src="'https://spiritvale.info/content/game/icons/element-Wind.webp'" style="display: inline; height: 2rem; margin-right: 0.5rem;" alt="Undead">Wind</h2>
            <ul>
                <li><strong>Description:</strong> Air and sky; swift and agile.</li>
                <li><strong>Creatures:</strong> Flying beasts, airborne insects, forest spirits.</li>
                <li><strong>Special:</strong> Overwhelms Water-type foes.</li>
                <li><strong>Strong against (125%):</strong> <ElementLabel element="Water"/></li>
                <li><strong>Weak against (75%):</strong> <ElementLabel element="Earth"/></li>
                <li><strong>Weapon Convert Card:</strong> <GameDataLink type="card" slug="wind-mage-card" /></li>
                <li><strong>Chest Convert Card:</strong> <GameDataLink type="card" slug="cat-bolt-card" /></li>
            </ul>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import { Head, Link } from '@inertiajs/vue3';
import WikiLayout from '@/Layouts/WikiLayout.vue';
import ElementLabel from '@/components/shared/ElementLabel.vue';
import GameDataLink from '@/components/shared/GameDataLink.vue';
</script>

<style scoped>

</style>