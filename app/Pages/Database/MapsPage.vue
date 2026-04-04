<template>
    <Head title="Maps - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Maps</h1>

        <div class="mb-3 w-full">
            <Input
                placeholder="Search..."
                v-model="filterText"
                class="border-gray-500/80 focus:border-blue-400 focus:ring-2 focus:ring-blue-400/30"
                @change="updateUrl"
            ></Input>
        </div>

        <div class="data-table">
            <table class="data-table">
                <thead>
                    <tr>
                        <th class="left">Name</th>
                        <th class="left">Monsters</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="map in filteredMaps"
                        :key="map.GameId"
                    >
                        <td>
                            <Link :href="'/maps/' + map.Slug">{{ map.DisplayName }}</Link>
                            <div
                                class="mt-2"
                                v-if="map.MonsterMinLevel > 0 || map.MonsterMaxLevel > 0"
                            >
                                <MyBadge>Lv {{ map.MonsterMinLevel }} - {{ map.MonsterMaxLevel }}</MyBadge>
                            </div>
                        </td>
                        <td>
                            <div
                                class="my-2"
                                v-for="monster in map.monsters"
                                :key="monster.GameId"
                            >
                                Lv.{{ monster.Level }}
                                <ElementLabel :element="monster.Element"></ElementLabel>
                                <Link
                                    :href="'/monsters/' + monster.Slug"
                                    class="mx-1"
                                    v-tippy="{
                                        contentLazy: { type: 'monster', slug: monster.Slug },
                                        interactive: false,
                                    }"
                                    >{{ monster.DisplayName }}</Link
                                >
                                <MyBadge
                                    color="yellow"
                                    v-if="monster.IsBoss"
                                    >BOSS</MyBadge
                                >
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
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { computed, ref, h } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import { Input } from '@/components/ui/input';
import MyBadge from '@/components/shared/MyBadge.vue';
import ElementLabel from '@/components/shared/ElementLabel.vue';
import { GameMap } from '@/types';

const props = defineProps<{
    search: string;
    maps: Array<GameMap>;
}>();

const maps = ref(props.maps);
maps.value = maps.value.sort((m1, m2) =>
    m1.MonsterMinLevel === m2.MonsterMinLevel
        ? m1.DisplayName.localeCompare(m2.DisplayName)
        : m1.MonsterMinLevel > m2.MonsterMinLevel
        ? 1
        : -1,
);

const monsters: object[] = [];
const monsterIds: string[] = [];
maps.value.forEach((map) => {
    map.monsters.forEach((monster) => {
        if (monsterIds[monster.id] === undefined) {
            monsterIds[monster.id] = monster.id;
            monsters.push(monster);
        }
    });
});

const filterText = ref(props.search);

const filteredMaps = computed(() => {
    let filteredMaps = maps.value;

    if (filterText.value !== '') {
        filteredMaps = filteredMaps.filter((m) => {
            if (m.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in m.monsters) {
                const monster = m.monsters[key];
                if (monster.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredMaps;
});

const updateUrl = () => {
    const searchParams = new URLSearchParams();
    if (filterText.value.trim() !== '') {
        searchParams.set('search', filterText.value.trim());
    }
    const query = searchParams.toString();
    if (query.length > 0) {
        window.history.replaceState(null, '', '/maps?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/maps');
    }
};
</script>

<style scoped></style>
