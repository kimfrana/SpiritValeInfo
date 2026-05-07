<template>
    <Head title="Attributes - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Attributes</h1>

            <p>
                The <strong>Attribute System</strong> defines the core growth of every character. Attributes determine
                how a character develops in combat and exploration, while directly influencing derived stats such as
                Attack, Defence and Hit Rate.
            </p>

            <p>
                There are two types of character levels:
            </p>
            <ul>
                <li>
                    <strong>Base Level</strong> – Determines a character’s overall level and provides attribute points.
                </li>
                <li>
                    <strong>Job Level</strong> – Determines a character’s job
                    progression and provides skill points.
                </li>
            </ul>

            <p>
                This page covers the Base Level system and how it grants attribute points that can be allocated to
                improve attributes. Attributes form the foundation of all character progression.
            </p>

            <p>
                Attributes matter because:
            </p>
            <ul>
                <li>They shape offensive and defensive potential.</li>
                <li>They directly modify core stats (HP, MP, ATK, etc.).</li>
                <li>They allow specialization for different playstyles (damage, tanking, speed, or critical hits).</li>
            </ul>

            <h2>Leveling and Attributes Points</h2>
            <p>
                Characters gain attribute points as they increase their Base Level.
            </p>
            <ul>
                <li>
                    All characters start at <strong>Base Level</strong> 1 with 27 attribute points automatically
                    distributed by class. These cannot be reallocated.
                </li>
                <li>
                    From <strong>Levels 2–100</strong>, players gain 3 points per level (297 total).
                </li>
                <li>
                    From <strong>Levels 101–130</strong>, players gain 2 points per level (60 total).
                </li>
                <li>
                    From Levels <strong>131–150</strong>, players gain 1 point per level (20 total).
                </li>
                <li><strong>Total points earned through leveling: 404.</strong></li>
            </ul>

            <h2>Allocation Rules</h2>
            <ul>
                <li>Attributes can be increased by spending attribute points.</li>
                <li>
                    Maximum point allocation is 99; higher values must come from other sources such as
                    equipment or artifacts.
                </li>
                <li>
                    Scaling costs:
                    <ul>
                        <li>1 point per level from 1–50</li>
                        <li>2 points per level from 51–98</li>
                        <li>3 points to reach 99</li>
                    </ul>
                </li>
                <li>A character can raise two attributes to 99 and still have 110 points left for others.</li>
            </ul>

            <h2>Attributes</h2>
            <h3>Strength (STR)</h3>
            <ul>
                <li>ATK with melee weapons.</li>
            </ul>

            <h3>Vitality (VIT)</h3>
            <ul>
                <li>Increases HP</li>
                <li>Increases DEF</li>
            </ul>

            <h3>Dexterity (DEX)</h3>
            <ul>
                <li>ATK with ranged weapons</li>
                <li>Increases HIT</li>
                <li>Increases BLOCK</li>
                <li>Increases CTR</li>
            </ul>

            <h3>Agility (AGI)</h3>
            <ul>
                <li>Increases FLEE</li>
                <li>Increases ASPD</li>
            </ul>

            <h3>Intelligence (INT)</h3>
            <ul>
                <li>Increases MATK</li>
                <li>Increases MP</li>
                <li>Increases MDEF</li>
            </ul>

            <h3>Luck (LUK)</h3>
            <ul>
                <li>Increases CRIT</li>
                <li>Increases CRIT DMG</li>
            </ul>

            <h2>Stats</h2>
            <h3>Health (HP)</h3>
            <ul>
                <li>Total amount of health; reaching <strong>0 HP</strong> results in death.</li>
                <li>Increased by Vitality.</li>
                <li><strong>Regen:</strong> X HP every 2s.</li>
            </ul>

            <h3>Mana (MP)</h3>
            <ul>
                <li>Resource used to cast skills.</li>
                <li>Increased by Intelligence.</li>
                <li><strong>Regen</strong>: X MP every 2s.</li>
            </ul>

            <h3>Attack (ATK) / Offhand Attack</h3>
            <ul>
                <li>Represents physical damage output.</li>
                <li>Increased by Strength (melee) and Dexterity (ranged).</li>
                <li>Used as the base number in damage calculations.</li>
            </ul>

            <h3>Magic Attack (MATK)</h3>
            <ul>
                <li>Represents magical damage output.</li>
                <li>Increased by Intelligence and Dexterity.</li>
                <li>Used as the base number in magical damage calculations.</li>
            </ul>

            <h3>Defence (DEF) / Flat Defence</h3>
            <ul>
                <li>DEF reduces incoming physical damage by a percentage.</li>
                <li>Flat Defence reduces incoming physical damage by a flat amount.</li>
                <li>Increased by Vitality.</li>
                <li><strong>Damage Reduction:</strong> X%</li>
            </ul>

            <h3>Magic Defence (MDEF) / Flat Magic Defence</h3>
            <ul>
                <li>MDEF reduces incoming magic damage by a percentage.</li>
                <li>Flat Magic Defence reduces incoming magic damage by a flat amount.</li>
                <li>Increased by Intelligence and Vitality.</li>
                <li><strong>Damage Reduction:</strong> X%</li>
            </ul>

            <h3>Hit (HIT)</h3>
            <ul>
                <li>Increases chance to hit enemies.</li>
                <li>Increased by Dexterity.</li>
                <li><strong>Hit Chance:</strong> X%</li>
            </ul>

            <h3>Flee (FLEE)</h3>
            <ul>
                <li>Increases chance to evade attacks (less effective against multiple enemies).</li>
                <li>Increased by Agility and Dexterity.</li>
                <li><strong>Evade Chance:</strong> X%</li>
            </ul>

            <h3>Critical Rate (CRIT) / Critical Damage (CRIT DMG)</h3>
            <ul>
                <li>Physical attacks and skills have a chance to deal critical hits.</li>
                <li>Increased by Luck.</li>
                <li><strong>X% chance</strong> to deal <strong>X% additional damage</strong>.</li>
            </ul>

            <h3>Block Rate (BLOCK)</h3>
            <ul>
                <li>Chance to negate physical attacks when using a shield.</li>
                <li>Increased by Dexterity.</li>
                <li><strong>Block Rate:</strong> X% (capped at 75%).</li>
            </ul>

            <h3>Attack Speed (ASPD)</h3>
            <ul>
                <li>Reduces delay between basic attacks and skills (capped at 193).</li>
                <li>Increased by Agility and Dexterity.</li>
                <li><strong>Attack Delay:</strong> X.XXs</li>
                <li><strong>Attacks Per Second:</strong> X.XX</li>
            </ul>

            <h3>Cast Time Reduction (CTR)</h3>
            <ul>
                <li>Reduces skill cast times.</li>
                <li>Increased by Dexterity and Intelligence.</li>
                <li><strong>Cast Time Reduction:</strong> X% (capped at 90%).</li>
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