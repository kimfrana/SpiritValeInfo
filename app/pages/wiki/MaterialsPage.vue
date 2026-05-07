<template>
    <Head title="Materials - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Materials</h1>

            <h2>Overview</h2>
            <p>
                Materials are items primarily used in <Link href="/wiki/Crafting_System">Crafting</Link> and
                <Link href="/wiki/Refinement_System">Refinement</Link>. They are stored in the Materials tab of
                the Inventory.
            </p>

            <h3>Refinement Materials</h3>
            <p>
                Refinement materials are required for upgrading <Link href="/wiki/Equipment">Equipment</Link> and
                <Link href="/wiki/Artifacts">Artifacts</Link>. Each refinement type comes in three rarities:
                shards, chunks, and crystals.
            </p>
            <ul>
                <li>
                    <GameDataLink type="material" slug="vulkanite-shard" />,
                    <GameDataLink type="material" slug="vulkanite-chunk" />,
                    <GameDataLink type="material" slug="vulkanite-crystal" />
                    — used to refine weapons in the <Link href="/wiki/Refinement_System">Refinement System</Link>
                </li>
                <li>
                    <GameDataLink type="material" slug="gravion-shard" />,
                    <GameDataLink type="material" slug="gravion-chunk" />,
                    <GameDataLink type="material" slug="gravion-crystal" />
                    — used to refine armor in the <Link href="/wiki/Refinement_System">Refinement System</Link>
                </li>
                <li>
                    <GameDataLink type="material" slug="lunaris-shard" />,
                    <GameDataLink type="material" slug="lunaris-chunk" />,
                    <GameDataLink type="material" slug="lunaris-crystal" />
                    — used to refine artifacts in the <Link href="/wiki/Refinement_System">Refinement System</Link>
                </li>
            </ul>

            <p><strong>Rarities:</strong></p>
            <ul>
                <li>
                    <strong>Shards</strong> — Common; found throughout the world and available for purchase.
                    Used for early refinements.
                </li>
                <li>
                    <strong>Chunks</strong> — Rare; more costly and used for most refinement steps.
                </li>
                <li>
                    <strong>Crystals</strong> — Extremely rare; found only in high-level areas and used
                    for the final refinement stages.
                </li>
            </ul>

            <h3>Crafting Materials</h3>
            <p>
                Crafting materials are gathered from <Link href="/wiki/Monsters">monsters</Link> and environments
                across various <Link href="/wiki/Maps">Maps</Link>. These are used by
                <Link href="/wiki/Craftsmen">Craftsmen</Link> NPCs throughout the world to create or enhance items.
            </p>
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