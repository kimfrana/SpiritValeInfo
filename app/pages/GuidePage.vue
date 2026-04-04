<template>
    <BaseLayout>
        <h1 class="page-title">{{ guide.title }}</h1>
        <div
            style="text-align: left"
            class="text-gray-400"
        >
            written by <span class="font-bold">{{ guide.author }}</span>
        </div>
        <p
            class="p-8 pt-12 text-justify markdown-content"
            v-html="html"
        ></p>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
import { marked } from 'marked';

const props = defineProps<{
    guide: {
        title: string;
        author: string;
        creationDate: string;
        lastModifiedDate: string;
        content: string;
    };
}>();

const html = marked.parse(props.guide.content);
</script>

<style scoped></style>
