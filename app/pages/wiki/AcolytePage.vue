<template>
    <Head title="Acolyte - SpiritVale Info"></Head>
    <WikiLayout>
        <div class="wiki-content">
            <h1 class="page-title">Acolyte</h1>

            <h2>Description</h2>
            <p>
                “A faithful healer who channels <ElementLabel element="Holy" /> light to protect allies and banish the <ElementLabel element="Undead" />. Ideal for players who enjoy support roles with a touch of offense.”
            </p>
            <p>
                <strong>More information coming soon!</strong>
            </p>
        </div>
    </WikiLayout>
</template>

<script setup lang="ts">

import WikiLayout from '@/Layouts/WikiLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import GameDataLink from '@/components/shared/GameDataLink.vue';
import ElementLabel from '@/components/shared/ElementLabel.vue';
</script>

<style scoped>

</style>