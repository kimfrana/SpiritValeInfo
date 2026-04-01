<template>
    <Head title="World Map - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">World Map</h1>

        <div
            style="display: inline-block; position: relative"
            class="p-4"
        >
            <img src="https://spiritvale.info/content/world-map.webp" />
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<style scoped></style>
