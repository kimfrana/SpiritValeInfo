<template>
    <div>
        <div>
            <span
                class="text-2xl font-bold"
                style="color: #ffe100; cursor: pointer"
                @click="router.get('/monsters/' + monster.Slug)"
                >{{ monster.DisplayName }}</span
            >
        </div>
        <div>
            <span
                class="text-lg font-bold"
                style="color: white; text-transform: uppercase"
                >Level {{ monster.Level }}</span
            >
            <span
                class="text-lg font-bold"
                style="color: white; text-transform: uppercase"
                v-if="monster.IsBoss"
            >
                BOSS</span
            >
        </div>
        <div>
            <span
                class="text-lg font-bold"
                :style="{ color: getElementColor(monster.Element) }"
                >{{ monster.Element }}</span
            >
            <span
                class="mx-1 text-rose-500"
                style="font-weight: bold"
                v-if="monster.IsHostile"
                >Aggressive</span
            >
        </div>
        <ElementDamageInfo :element="monster.Element"></ElementDamageInfo>

        <div
            class="mt-2"
            style="display: flex; flex-wrap: wrap; gap: 1rem"
            v-if="monster.drops"
        >
            <template
                v-for="drop in monster.drops"
                :key="drop.slug"
            >
                <div
                    style="
                        height: 3.65rem;
                        width: 3.65rem;
                        background-color: #242633;
                        position: relative;
                        cursor: pointer;
                    "
                    @click="router.get('/equipment/' + drop.slug)"
                    v-if="drop.type === 'equipment'"
                    v-tippy="{ contentLazy: { type: drop.type, slug: drop.slug } }"
                >
                    <img
                        loading="lazy"
                        :src="'https://spiritvale.info/content/game/icons/' + drop.icon + '.webp'"
                        :alt="drop.name"
                        style="width: 100px; display: inline"
                    />
                    <span
                        style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            font-size: 0.6rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            line-height: 0.5rem;
                            font-weight: bold;
                            padding: 0.1rem;
                            padding-top: 0;
                        "
                        >{{ drop.name }}</span
                    >
                    <span
                        style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            font-size: 0.7rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            font-weight: bold;
                            padding: 0.1rem 0.2rem;
                        "
                        >{{ drop.chance }}%</span
                    >
                </div>
                <div
                    style="
                        height: 3.65rem;
                        width: 3.65rem;
                        background-color: #242633;
                        position: relative;
                        cursor: pointer;
                    "
                    @click="router.get('/cards/' + drop.slug)"
                    v-if="drop.type === 'card'"
                    v-tippy="{ contentLazy: { type: drop.type, slug: drop.slug } }"
                >
                    <img
                        loading="lazy"
                        :src="'https://spiritvale.info/content/game/icons/' + drop.icon + '.webp'"
                        :alt="drop.name"
                        style="width: 100px; display: inline"
                    />
                    <span
                        style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            font-size: 0.6rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            line-height: 0.5rem;
                            font-weight: bold;
                            padding: 0.1rem;
                            padding-top: 0;
                        "
                        >{{ drop.name }}</span
                    >
                    <span
                        style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            font-size: 0.7rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            font-weight: bold;
                            padding: 0.1rem 0.2rem;
                        "
                        >{{ drop.chance }}%</span
                    >
                </div>
                <div
                    style="
                        height: 3.65rem;
                        width: 3.65rem;
                        background-color: #242633;
                        position: relative;
                        cursor: pointer;
                    "
                    @click="router.get('/materials/' + drop.slug)"
                    v-if="drop.type === 'material'"
                    v-tippy="{ contentLazy: { type: drop.type, slug: drop.slug } }"
                >
                    <img
                        loading="lazy"
                        :src="'https://spiritvale.info/content/game/icons/' + drop.icon + '.webp'"
                        :alt="drop.name"
                        style="width: 100px; display: inline"
                    />
                    <span
                        style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            font-size: 0.6rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            line-height: 0.5rem;
                            font-weight: bold;
                            padding: 0.1rem;
                            padding-top: 0;
                        "
                        >{{ drop.name }}</span
                    >
                    <span
                        style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            font-size: 0.7rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            font-weight: bold;
                            padding: 0.1rem 0.2rem;
                        "
                        >{{ drop.chance }}%</span
                    >
                </div>
                <div
                    style="
                        height: 3.65rem;
                        width: 3.65rem;
                        background-color: #242633;
                        position: relative;
                        cursor: pointer;
                    "
                    @click="router.get('/consumables/' + drop.slug)"
                    v-if="drop.type === 'consumable'"
                    v-tippy="{ contentLazy: { type: drop.type, slug: drop.slug } }"
                >
                    <img
                        loading="lazy"
                        :src="'https://spiritvale.info/content/game/icons/' + drop.icon + '.webp'"
                        :alt="drop.name"
                        style="width: 100px; display: inline"
                    />
                    <span
                        style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            font-size: 0.6rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            line-height: 0.5rem;
                            font-weight: bold;
                            padding: 0.1rem;
                            padding-top: 0;
                        "
                        >{{ drop.name }}</span
                    >
                    <span
                        style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            font-size: 0.7rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            font-weight: bold;
                            padding: 0.1rem 0.2rem;
                        "
                        >{{ drop.chance }}%</span
                    >
                </div>
                <div
                    style="
                        height: 3.65rem;
                        width: 3.65rem;
                        background-color: #242633;
                        position: relative;
                        cursor: pointer;
                    "
                    @click="router.get('/gems/' + drop.slug)"
                    v-if="drop.type === 'gem'"
                    v-tippy="{ contentLazy: { type: drop.type, slug: drop.slug } }"
                >
                    <img
                        loading="lazy"
                        :src="'https://spiritvale.info/content/game/icons/' + drop.icon + '.webp'"
                        :alt="drop.name"
                        style="width: 100px; display: inline"
                    />
                    <span
                        style="
                            position: absolute;
                            top: 0;
                            left: 0;
                            right: 0;
                            font-size: 0.6rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            line-height: 0.5rem;
                            font-weight: bold;
                            padding: 0.1rem;
                            padding-top: 0;
                        "
                        >{{ drop.name }}</span
                    >
                    <span
                        style="
                            position: absolute;
                            bottom: 0;
                            right: 0;
                            font-size: 0.7rem;
                            background-color: rgba(0, 0, 0, 0.8);
                            color: #ddd;
                            text-align: center;
                            display: inline-block;
                            font-weight: bold;
                            padding: 0.1rem 0.2rem;
                        "
                        >{{ drop.chance }}%</span
                    >
                </div>
            </template>
        </div>

        <div
            class="mt-4"
            v-if="monster.skillList.length > 0"
        >
            <div><span class="text-lg font-bold">Skills</span></div>
            {{ monster.skillList.join(', ') }}
        </div>
    </div>
</template>

<script setup lang="ts">
import { getElementColor } from '@/services/util';
import ElementDamageInfo from '@/components/shared/ElementDamageInfo.vue';
import { Monster } from '@/types';
import { Link, router } from '@inertiajs/vue3';
import { directive as vTippy } from 'vue-tippy';

defineProps<{
    monster: Monster;
    show?: boolean;
}>();
</script>

<style scoped></style>
