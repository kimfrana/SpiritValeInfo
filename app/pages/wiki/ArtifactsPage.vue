<template>
    <Head title="Artifacts - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Artifacts</h1>

            <h2>Overview</h2>
            <p>
                Artifacts are a special category of equipment made up of four coordinated pieces that occupy
                the Artifact slots. When equipped, they grant powerful passive effects, and each piece can be
                refined to further enhance its stats.
            </p>
            <ul>
                <li>Artifacts are worn only in the dedicated Artifact slots.</li>
                <li>
                    There are four artifact piece types:
                    <ul>
                        <li><strong>Relics</strong></li>
                        <li><strong>Gems</strong></li>
                        <li><strong>Scrolls</strong></li>
                        <li><strong>Runes</strong></li>
                    </ul>
                </li>
                <li>
                    Apart from their slot location, the four piece types do not confer different powers. Only
                    the set they belong to determines the effects.
                </li>
            </ul>

            <h2>How Artifact Bonuses Work</h2>
            <p>
                An artifact piece will always show the following lines in its tooltip:
            </p>
            <ul>
                <li><strong>Per Piece</strong> - The amount granted by each equipped piece in the set.</li>
                <li>
                    <strong>Full Set</strong> - A bonus granted only when all four Artifact slots are filled
                    with pieces from the same named set.
                </li>
                <li>
                    <strong>Per Refine</strong> - A value that scales with the refinement level of the
                    individual piece (up to +10).
                </li>
                <li>
                    <strong>Random Rolls</strong> - Two random affixes:
                    <ul>
                        <li>
                            One roll is always +2 or +3 to one of the six attributes:
                            <ul>
                                <li>STR</li>
                                <li>AGI</li>
                                <li>VIT</li>
                                <li>INT</li>
                                <li>LUK</li>
                                <li>DEX</li>
                            </ul>
                        </li>
                        <li>
                            One roll is always +5% damage to a random attacking skill of a base class
                            (see <Link href="/wiki/Classes">Classes</Link>).
                        </li>
                    </ul>
                </li>
            </ul>
            <p><strong>Matching Pieces</strong></p>
            <p>
                Pieces match when they share the exact same set name (for example, “Windborne”). Any combination+
                of Relic, Gem, Scroll, and Rune with that same name will complete the set.
            </p>

            <h2>Refinement</h2>
            <p>
                Artifact pieces can be refined individually up to +10, improving any stats listed
                under Per Refine on that item.
            </p>
            <ul>
                <li>Refinement bonuses stack across all equipped pieces.</li>
                <li>Refinement does not change the set name or piece type.</li>
                <li>
                    See <Link href="/wiki/Refinement_System">Refinement</Link> for materials, success chances,
                    and mechanics.
                </li>
            </ul>

            <h2>Drop Sources</h2>
            <ul>
                <li>
                    Each map (or group of closely related <Link href="/wiki/Maps">maps</Link>) has its own
                    named artifact set.
                </li>
                <li>
                    Some zones share a set across multiple maps.
                    <ul>
                        <li>Example: The Forest Labyrinth zone contains many maps that drop the Windborne set.</li>
                    </ul>
                </li>
                <li>
                    Bosses and normal monsters within the same zone can drop the same set, with rates varying by
                    enemy type.
                </li>
            </ul>

            <h2>Identifying a Set In-Game</h2>
            <ul>
                <li>Hover over an artifact in your inventory to inspect its tooltip.</li>
                <li>
                    Look for:
                    <ul>
                        <li>The <strong>set name</strong> at the top (used to determine matching pieces).</li>
                        <li>
                            The <strong>Per Piece</strong>, <strong>Full Set</strong>, and <strong>Per Refine</strong>
                            lines (core scaling).
                        </li>
                        <li>The two <strong>Random Rolls</strong> (one attribute +2/+3, one base-class skill +5%).</li>
                    </ul>
                </li>
            </ul>

            <h2>Building Loadout</h2>
            <ul>
                <li>First, determine which Full Set bonus best fits your build.</li>
                <li>Farm the set until you obtain pieces with the desired attribute bonus and base-class skill boost.</li>
                <li>Finally, refine the pieces to increase the Per Refine total across the set.</li>
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