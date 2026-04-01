<template>
    <BaseLayout>
        <h1 class="page-title">Guides</h1>
        <ul class="default-list">
            <li><Link href="/guide/1/Beginners-Guide">Beginner's Guide</Link></li>
        </ul>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
</script>

<style scoped></style>
