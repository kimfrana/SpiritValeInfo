<template>
    <Head title="SpiritVale Info" />
    <BaseLayout>
        <div class="page-content space-y-6">
            <section class="section-panel">
                <div style="float: right;">
                    <div style="display:grid; grid-template-columns:repeat(auto-fit, 100px); justify-content:center; gap:8px; place-items:center; width:450px; min-width:0; margin-top:.45rem;">
                        <div class="sv-hover-lift"><a href="https://store.steampowered.com/app/3767850/SpiritVale/" rel="nofollow"><img :src="'/images/Steam-logo.webp'" width="96" height="30" alt="Steam Page" /></a></div>
                        <div class="sv-hover-lift"><a href="https://discord.gg/SpiritVale" rel="nofollow"><img :src="'/images/Discord-logo.webp'" width="96" height="30" alt="Discord Server" /></a></div>
                        <div class="sv-hover-lift"><a href="https://www.reddit.com/r/SpiritVale/" rel="nofollow"><img :src="'/images/Reddit-logo.webp'" width="96" height="30" alt="Reddit" /></a></div>
                        <div class="sv-hover-lift"><a href="https://ko-fi.com/renbaikun" rel="nofollow"><img :src="'/images/Kofi-logo.webp'" width="96" height="30" alt="Kofi" /></a></div>
                    </div>
                </div>
                <h1 class="page-title page-title-hero">SpiritVale</h1>
                <p class="mt-4">
                    SpiritVale is a free-to-play, class-based action MMORPG inspired by Ragnarok Online. Build your
                    own hero, battle corrupted creatures, and uncover lost history in a world torn by magic and decay.
                </p>
                <p class="mt-4">
                    Choose a base class —
                    <Link href="/wiki/Warrior">Warrior</Link>,
                    <Link href="/wiki/Warrior">Knight</Link>,
                    <Link href="/wiki/Warrior">Mage</Link>,
                    <Link href="/wiki/Warrior">Rogue</Link>,
                    <Link href="/wiki/Warrior">Scout</Link>,
                    <Link href="/wiki/Acolyte">Acolyte</Link>
                    or <Link href="/wiki/Summoner">Summoner</Link> — and unlock
                    unique skill trees and advanced specializations as you grow. Explore diverse biomes, battle
                    powerful bosses, and team up with friends in real-time, action-based combat.
                </p>
                <video class="mt-4" autoplay="" muted="" loop="" playsinline="" poster="https://spiritale.info/video-home.avif" width="1170" height="426"><source src="https://spiritale.info/content/video-home.webm" type="video/webm; codecs=vp9"><source src="https://spiritvale.info/content/video-home.mp4" type="video/mp4"></video>
            </section>

            <section class="section-panel">
                <h2 class="section-title">Patch Notes</h2>
                <div class="mt-4" style="display: flex; gap: 1rem;">
                    <div>
                        <img src="https://clan.fastly.steamstatic.com/images/45704998/8332c7504694d062bf29b5898775b07d88ee2a13_400x225.png" />
                        <a href="https://store.steampowered.com/news/app/3767850/view/659355805326246313" target="_blank" class="mt-1" style="font-size: 1.2rem; font-weight: bold; display: block;">[0.16] Rebalance Patch</a>
                        <span style="display: block; text-align: left; font-size: 0.8rem;">April 19th 2026</span>
                    </div>
                    <div>
                        <img src="https://clan.fastly.steamstatic.com/images/45704998/569799fc52a38c5ae68733e9465d87b7e23ad71e_400x225.png" />
                        <a href="https://store.steampowered.com/news/app/3767850/view/517485982814044621" target="_blank" class="mt-1" style="font-size: 1.2rem; font-weight: bold; display: block;">[0.12] Berserker</a>
                        <span style="display: block; text-align: left; font-size: 0.8rem;">February 2nd 2026</span>
                    </div>
                </div>

            </section>

            <section class="section-panel">
                <h2 class="section-title">Game Mechanics</h2>
                <div class="mt-4" style="display: flex; gap: 1rem;">
                    <a href="/wiki/Classes" class="home-button">Classes</a>
                    <a href="/wiki/Attributes" class="home-button">Attributes</a>
                    <a href="/wiki/Item_Storage" class="home-button">Storage</a>
                    <a href="/wiki/Dodge_Roll" class="home-button">Dodge Roll</a>
                    <a href="/wiki/Elements" class="home-button">Elements</a>
                    <a href="/wiki/Arena" class="home-button">Arena</a>
                    <a href="/wiki/Waypoints" class="home-button">Waypoints</a>
                    <a href="/wiki/Refinement_System" class="home-button">Refinement</a>
                    <a href="/wiki/Crafting_System" class="home-button">Crafting</a>
                </div>
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
                    This is a <Link href="/team">community driven</Link> open source project, so if you want to help us, please check out our
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
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    wikiPages: Array<{ name: string; url: string }>;
}>();
</script>

<style scoped>
.sv-hover-lift {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.sv-hover-lift:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
}

.home-button {
    background-color: #005ac9; border-radius: 0.5rem; padding: 0.5rem 0.75rem; display: inline-block;
    cursor: pointer;
    color: white;
}
.home-button:hover {
    background-color: #0069ef;
    color: white;
}
</style>
