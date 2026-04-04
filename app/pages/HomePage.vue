<template>
    <Head title="SpiritVale Info" />
    <BaseLayout>
        <div class="page-content space-y-6">
            <section class="section-panel">
                <h1 class="page-title page-title-hero">SpiritVale Info</h1>
                <p>
                    Welcome to <strong>SpiritVale Info</strong>. This a
                    <a href="/team">community driven</a>
                    info page about the MMORPG <strong>SpiritVale</strong>. Like the game this project is in an early
                    stage of development.
                </p>
                <p class="mt-4">
                    If you are looking for official sites check out the
                    <a
                        href="https://store.steampowered.com/app/3767850/SpiritVale/?beta=1"
                        target="_blank"
                        rel="noreferrer"
                        >Steam Page</a
                    >
                    or join the
                    <a
                        href="https://discord.gg/u3ZZQFFG3v"
                        target="_blank"
                        rel="noreferrer"
                        >Official Discord Server</a
                    >.
                </p>
            </section>

            <div class="section-divider"></div>

            <section class="section-panel">
                <h2 class="section-title">Wiki</h2>
                <ul class="default-list mt-4">
                    <li>
                        <a
                            href="https://spiritvale.info/wiki/Classes"
                            target="_blank"
                            rel="noreferrer"
                            >Classes</a
                        >
                    </li>
                    <li
                        v-for="wikiPage in wikiPages"
                        :key="wikiPage.name"
                    >
                        <a
                            :href="wikiPage.url"
                            target="_blank"
                            rel="noreferrer"
                            >{{ wikiPage.name }}</a
                        >
                    </li>
                </ul>
            </section>

            <section class="section-panel">
                <h2 class="section-title">Support Game Development</h2>
                <p class="mt-3">
                    If you want to support the developer you can do so on
                    <img
                        style="height: 0.8rem; display: inline; vertical-align: baseline"
                        src="https://spiritvale.info/content/logo-kofi.webp"
                    />
                    <a
                        href="https://ko-fi.com/renbaikun"
                        target="_blank"
                        rel="noreferrer"
                        >Ko-Fi</a
                    >.
                </p>
            </section>

            <section class="section-panel">
                <h2 class="section-title">Help Us</h2>
                <p class="mt-3">
                    This project is open source so if you want to help us, please check out our
                    <a
                        href="https://github.com/RandomGuy5555/SpiritValeInfo"
                        target="_blank"
                        rel="noreferrer"
                        >GitHub repository</a
                    >.
                </p>
            </section>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    wikiPages: Array<{ name: string; url: string }>;
}>();
</script>
