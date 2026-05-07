<template>
    <Head title="Monsters - SpiritVale Info"></Head>
    <BaseLayout>
        <div class="w-full">
            <h1 class="page-title">Monsters</h1>

            <div class="filter-row">
            <MySelect
                :options="optionsElement"
                placeholder="Element"
                v-model="filterElement"
                @change="updateUrl"
            ></MySelect>

            <MySelect
                :options="optionsType"
                placeholder="Type"
                v-model="filterType"
                @change="updateUrl"
            ></MySelect>
            </div>

            <div class="mb-3 w-full">
            <Input
                placeholder="Search..."
                v-model="filterText"
                class="border-gray-500/80 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/30"
                @change="updateUrl"
            ></Input>
            </div>

            <div class="data-table overflow-x-auto">
                <table class="data-table min-w-[900px]">
                <thead>
                    <tr>
                        <th class="left">Name</th>
                        <th>Drops</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="monster in filteredMonsters"
                        :key="monster.GameId"
                    >
                        <td>
                            <span class="inline-flex items-center gap-1.5">
                                <Link
                                    :href="'/monsters/' + monster.Slug"
                                    class="mr-1"
                                    v-tippy="{ contentLazy: { type: 'monster', slug: monster.Slug } }"
                                    >{{ monster.DisplayName }}</Link
                                >
                                <span
                                    v-if="monster.IsBoss"
                                    class="inline-flex h-5 w-5 items-center justify-center rounded-full border border-yellow-300 bg-yellow-300/15 text-yellow-300 has-tooltip"
                                    v-tippy="'Boss'"
                                    aria-label="Boss"
                                >
                                    <img
                                        class="h-full w-full"
                                        :src="'/navbar/icon-boss-crown.svg'"
                                        alt=""
                                        aria-hidden="true"
                                    />
                                </span>
                                <span
                                    class="inline-flex h-5 w-5 items-center justify-center rounded-full text-rose-500 has-tooltip"
                                    v-if="monster.IsHostile"
                                    v-tippy="{ content: 'Aggressive', theme: 'spiritvale aggressive' }"
                                    aria-label="Aggressive"
                                >
                                    <img
                                        class="h-full w-full"
                                        :src="'/navbar/icon-aggressive-alert.svg'"
                                        alt=""
                                        aria-hidden="true"
                                    />
                                </span>
                            </span>
                            <div class="my-2 flex flex-wrap items-center gap-1.5 text-xs">
                                <span class="rounded-md border border-gray-200/60 px-2 py-0.5 text-gray-200">Lv {{ monster.Level }}</span>
                                <span
                                    class="rounded-full border px-2 py-0.5"
                                    :style="{ color: getElementColor(monster.Element), borderColor: getElementColor(monster.Element), fontWeight: 'bold' }"
                                >
                                    <img :src="'https://spiritvale.info/content/game/icons/element-' + monster.Element + '.webp'" style="display: inline; height: 0.8rem;" :alt="monster.Element">
                                    {{ monster.Element }}
                                </span>
                            </div>
                        </td>
                        <td>
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
                                            style="width: 100%; height: 100%; object-fit: contain; display: block"
                                        />
                                        <span
                                            style="
                                                position: absolute;
                                                top: 0;
                                                left: 50%;

                                                font-size: 0.6rem;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                transform: translateX(-50%);
                                                max-width: calc(100% - 0.2rem);
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                display: inline-block;
                                                line-height: 0.85rem;
                                                font-weight: bold;
                                                padding: 0.16rem 0.22rem;

                                            "
                                            >{{ drop.name }}</span
                                        >
                                        <span
                                            style="
                                                position: absolute;
                                                bottom: 0;
                                                right: 0;
                                                font-size: 0.7rem;
                                                font-variant-numeric: tabular-nums;
                                                width: 1.8rem;
                                                min-width: 1.8rem;
                                                max-width: 1.8rem;
                                                border-radius: 0.25rem;
                                                box-sizing: border-box;
                                                align-items: center;
                                                justify-content: center;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                display: inline-flex;
                                                font-weight: bold;
                                                padding: 0;
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
                                            style="width: 100%; height: 100%; object-fit: contain; display: block"
                                        />
                                        <span
                                            style="
                                                position: absolute;
                                                top: 0;
                                                left: 50%;

                                                font-size: 0.6rem;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                transform: translateX(-50%);
                                                max-width: calc(100% - 0.2rem);
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                display: inline-block;
                                                line-height: 0.85rem;
                                                font-weight: bold;
                                                padding: 0.16rem 0.22rem;

                                            "
                                            >{{ drop.name }}</span
                                        >
                                        <span
                                            style="
                                                position: absolute;
                                                bottom: 0;
                                                right: 0;
                                                font-size: 0.7rem;
                                                font-variant-numeric: tabular-nums;
                                                width: 1.8rem;
                                                min-width: 1.8rem;
                                                max-width: 1.8rem;
                                                border-radius: 0.25rem;
                                                box-sizing: border-box;
                                                align-items: center;
                                                justify-content: center;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                display: inline-flex;
                                                font-weight: bold;
                                                padding: 0;
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
                                            style="width: 100%; height: 100%; object-fit: contain; display: block"
                                        />
                                        <span
                                            style="
                                                position: absolute;
                                                top: 0;
                                                left: 50%;

                                                font-size: 0.6rem;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                transform: translateX(-50%);
                                                max-width: calc(100% - 0.2rem);
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                display: inline-block;
                                                line-height: 0.85rem;
                                                font-weight: bold;
                                                padding: 0.16rem 0.22rem;

                                            "
                                            >{{ drop.name }}</span
                                        >
                                        <span
                                            style="
                                                position: absolute;
                                                bottom: 0;
                                                right: 0;
                                                font-size: 0.7rem;
                                                font-variant-numeric: tabular-nums;
                                                width: 1.8rem;
                                                min-width: 1.8rem;
                                                max-width: 1.8rem;
                                                border-radius: 0.25rem;
                                                box-sizing: border-box;
                                                align-items: center;
                                                justify-content: center;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                display: inline-flex;
                                                font-weight: bold;
                                                padding: 0;
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
                                            style="width: 100%; height: 100%; object-fit: contain; display: block"
                                        />
                                        <span
                                            style="
                                                position: absolute;
                                                top: 0;
                                                left: 50%;

                                                font-size: 0.6rem;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                transform: translateX(-50%);
                                                max-width: calc(100% - 0.2rem);
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                display: inline-block;
                                                line-height: 0.85rem;
                                                font-weight: bold;
                                                padding: 0.16rem 0.22rem;

                                            "
                                            >{{ drop.name }}</span
                                        >
                                        <span
                                            style="
                                                position: absolute;
                                                bottom: 0;
                                                right: 0;
                                                font-size: 0.7rem;
                                                font-variant-numeric: tabular-nums;
                                                width: 1.8rem;
                                                min-width: 1.8rem;
                                                max-width: 1.8rem;
                                                border-radius: 0.25rem;
                                                box-sizing: border-box;
                                                align-items: center;
                                                justify-content: center;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                display: inline-flex;
                                                font-weight: bold;
                                                padding: 0;
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
                                            :src="'https://spiritvale.info/content/game/icons/item-' + drop.icon + '.webp'"
                                            :alt="drop.name"
                                            style="width: 100%; height: 100%; object-fit: contain; display: block"
                                        />
                                        <span
                                            style="
                                                position: absolute;
                                                top: 0;
                                                left: 50%;

                                                font-size: 0.6rem;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                transform: translateX(-50%);
                                                max-width: calc(100% - 0.2rem);
                                                white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                display: inline-block;
                                                line-height: 0.85rem;
                                                font-weight: bold;
                                                padding: 0.16rem 0.22rem;

                                            "
                                            >{{ drop.name }}</span
                                        >
                                        <span
                                            style="
                                                position: absolute;
                                                bottom: 0;
                                                right: 0;
                                                font-size: 0.7rem;
                                                font-variant-numeric: tabular-nums;
                                                width: 1.8rem;
                                                min-width: 1.8rem;
                                                max-width: 1.8rem;
                                                border-radius: 0.25rem;
                                                box-sizing: border-box;
                                                align-items: center;
                                                justify-content: center;
                                                background-color: rgba(36, 44, 64, 0.72);
                                                color: #ddd;
                                                text-align: left;
                                                display: inline-flex;
                                                font-weight: bold;
                                                padding: 0;
                                            "
                                            >{{ drop.chance }}%</span
                                        >
                                    </div>
                                </template>
                            </div>
                        </td>
                    </tr>
                </tbody>
                </table>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { computed, ref, h } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import MySelect from '@/components/shared/MySelect.vue';
import { Input } from '@/components/ui/input';
import { getElementColor } from '@/services/util';
import { Monster } from '@/types';

const props = defineProps<{
    element: string;
    type: string;
    search: string;
    monsters: Array<Monster>;
    gameData: {
        monsters: Array<Monster>;
    };
}>();

const optionsElement = [
    { value: 'All', label: 'All (Element)' },
    { value: 'Neutral', label: 'Neutral' },
    { value: 'Fire', label: 'Fire' },
    { value: 'Water', label: 'Water' },
    { value: 'Earth', label: 'Earth' },
    { value: 'Wind', label: 'Wind' },
    { value: 'Poison', label: 'Poison' },
    { value: 'Holy', label: 'Holy' },
    { value: 'Shadow', label: 'Shadow' },
    { value: 'Undead', label: 'Undead' },
];

const optionsType = [
    { value: 'All', label: 'All (Type)' },
    { value: 'Boss', label: 'Boss' },
    { value: 'Normal', label: 'Normal' },
];

const monsters = ref(props.monsters);
monsters.value = monsters.value.sort((m1, m2) =>
    m1.Level === m2.Level ? m1.DisplayName.localeCompare(m2.DisplayName) : m1.Level > m2.Level ? 1 : -1,
);

const filterElement = ref(props.element);
const filterType = ref(props.type);
const filterText = ref(props.search);

const filteredMonsters = computed(() => {
    let filteredMonsters = monsters.value;

    if (filterElement.value !== 'All') {
        filteredMonsters = filteredMonsters.filter((m) => m.Element === filterElement.value);
    }

    if (filterType.value !== 'All') {
        filteredMonsters = filteredMonsters.filter((m) => m.IsBoss === (filterType.value === 'Boss' ? 1 : 0));
    }

    if (filterText.value !== '') {
        filteredMonsters = filteredMonsters.filter((m) => {
            if (m.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in m.drops) {
                const drop = m.drops[key];
                if (drop.name.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredMonsters;
});

const updateUrl = () => {
    const searchParams = new URLSearchParams();
    if (filterElement.value !== 'All') {
        searchParams.set('element', filterElement.value);
    }
    if (filterType.value !== 'All') {
        searchParams.set('type', filterType.value);
    }
    if (filterText.value.trim() !== '') {
        searchParams.set('search', filterText.value.trim());
    }
    const query = searchParams.toString();
    if (query.length > 0) {
        window.history.replaceState(null, '', '/monsters?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/monsters');
    }
};
</script>
