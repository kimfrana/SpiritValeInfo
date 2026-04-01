<template>
    <Head title="Monsters - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Monsters</h1>

        <div class="flex w-full max-w-sm items-center gap-1.5 mb-2">
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

            <Input
                placeholder="Search..."
                v-model="filterText"
                @change="updateUrl"
            ></Input>
        </div>

        <div class="data-table">
            <table class="data-table">
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
                            <Link
                                :href="'/monsters/' + monster.Slug"
                                class="mr-2"
                                v-tippy="{ contentLazy: { type: 'monster', slug: monster.Slug } }"
                                >{{ monster.DisplayName }}</Link
                            >
                            <MyBadge
                                color="yellow"
                                v-if="monster.IsBoss"
                                >BOSS</MyBadge
                            >
                            <div class="my-2">
                                <MyBadge>Lv {{ monster.Level }}</MyBadge>
                                <ElementLabel :element="monster.Element"></ElementLabel>
                                <span
                                    class="mx-1 text-rose-500"
                                    style="font-weight: bold"
                                    v-if="monster.IsHostile"
                                    >Aggressive</span
                                >
                                <span
                                    class="mx-1 text-blue-400 has-tooltip"
                                    style="font-weight: bold"
                                    v-tippy="monster.skillList.join(', ')"
                                    v-if="monster.skillList.length > 0"
                                    >Skills
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
                                            :src="'https://spiritvale.info/content/game/icons/item-' + drop.icon + '.webp'"
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
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { computed, ref, h } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import MySelect from '@/components/shared/MySelect.vue';
import { Input } from '@/components/ui/input';
import MyBadge from '@/components/shared/MyBadge.vue';
import ElementLabel from '@/components/shared/ElementLabel.vue';
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

<style scoped></style>
