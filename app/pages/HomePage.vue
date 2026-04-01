<template>
    <Head title="SpiritVale Info" />
    <BaseLayout>
        <h1 class="page-title">SpiritVale Info</h1>
        <p>
            Welcome to <strong>SpiritVale Info</strong>. This a <a href="/team">community driven</a> info page about the
            MMORPG <strong>SpiritVale</strong>. Like the game this project is in an early stage of development.
        </p>
        <p class="mt-4">
            If you are looking for official sites check out the
            <a
                href="https://store.steampowered.com/app/3767850/SpiritVale/?beta=1"
                target="_blank"
                >Steam Page</a
            >
            or join the
            <a
                href="https://discord.gg/u3ZZQFFG3v"
                target="_blank"
                >Official Discord Server</a
            >.
        </p>

        <h2 class="mt-4">Wiki</h2>
        <ul class="default-list">
            <li>
                <a
                    href="https://spiritvale.info/wiki/Classes"
                    target="_blank"
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
                    >{{ wikiPage.name }}</a
                >
            </li>
        </ul>

        <h2 class="mt-4">Support Game Development</h2>
        If you want to support the developer you can do so on
        <img
            style="height: 0.8rem; display: inline; vertical-align: baseline"
            src="https://spiritvale.info/content/logo-kofi.webp"
        />
        <a
            href="https://ko-fi.com/renbaikun"
            target="_blank"
            >Ko-Fi</a
        >.

        <h2 class="mt-4">Help Us</h2>
        This project is open source so if you want to help us, please check out our
        <a
            href="https://github.com/RandomGuy5555/SpiritValeInfo"
            target="_blank"
            >GitHub repository</a
        >.
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    wikiPages: Array<{ name: string; url: string }>;
}>();
</script>

<style scoped></style>
