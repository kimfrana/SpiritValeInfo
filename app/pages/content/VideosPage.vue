<template>
    <Head title="Videos - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Videos</h1>

        <div
            style="margin: 1rem 0"
            v-for="video in videos"
            :key="video.url"
        >
            <h2>{{ video.name }}</h2>
            <p v-if="video.description">{{ video.description }}</p>
            <video
                style="max-width: 100%"
                width="640"
                controls
                :poster="video.previewImage"
                v-if="video.player === 'html'"
            >
                <source
                    :src="video.url"
                    type="video/mp4"
                />
            </video>
            <a
                href="video.url"
                target="_blank"
                v-else
                >{{ video.url }}</a
            >
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';

type Video = { name: string; description: string; url: string; previewImage: string; player: 'html' | 'youtube' };

defineProps<{
    videos: Video[];
}>();
</script>

<style scoped></style>
