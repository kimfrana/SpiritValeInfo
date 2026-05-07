<template>
    <AppHeader />
    <AppSidebar />

    <main class="p-4 sm:ml-64">
        <div class="mt-14 p-4">
            <slot></slot>

            <WikiNavigation/>
        </div>
    </main>

    <TooltipHost />
</template>

<script setup lang="ts">
import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import AppHeader from '@/components/layout/AppHeader.vue';
import AppSidebar from '@/components/layout/AppSidebar.vue';
import TooltipHost from '@/components/layout/TooltipHost.vue';
import WikiNavigation from '@/components/shared/WikiNavigation.vue';

onMounted(() => {
    initFlowbite();
});
</script>

<style scoped></style>
