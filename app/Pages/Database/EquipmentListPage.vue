<template>
    <Head title="Equipment - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Equipment</h1>

        <div class="filter-row">
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

        <div class="data-table">
            <table class="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Equipment</th>
                        <th>Stats</th>
                        <th>Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="equipment in filteredEquipmentList"
                        :key="equipment.Slug"
                    >
                        <td style="width: 100px">
                            <img
                                loading="lazy"
                                style="width: 64px"
                                :src="'https://spiritvale.info/content/game/icons/item-' + equipment.icon + '.webp'"
                                :alt="equipment.DisplayName"
                            />
                        </td>
                        <td>
                            <div>
                                <Link
                                    :href="'/equipment/' + equipment.Slug"
                                    v-tippy="{ contentLazy: { type: 'equipment', slug: equipment.Slug } }"
                                    >{{ equipment.DisplayName }}</Link
                                >
                            </div>
                            <div class="my-2">
                                <MyBadge>{{ equipment.typeName }}</MyBadge>
                            </div>
                            <div class="my-2">
                                <MyBadge>{{ equipment.Slots }} Card Slots</MyBadge>
                            </div>
                        </td>
                        <td>
                            <div
                                v-for="stat in equipment.statsPrimary"
                                v-html="stat"
                            ></div>
                            <div v-if="equipment.statsPrimary.length > 0 && equipment.statsSecondary.length > 0">
                                ----------------
                            </div>
                            <div
                                v-for="stat in equipment.statsSecondary"
                                v-html="stat"
                            ></div>
                        </td>
                        <td>
                            <div v-if="equipment.drops.length > 0">
                                <div
                                    class="my-2"
                                    v-for="drop in equipment.drops"
                                    :key="drop.monster.name"
                                >
                                    Lv {{ drop.monster.level }}
                                    <Link :href="'/monsters/' + drop.monster.slug">{{ drop.monster.name }}</Link>
                                    <MyBadge
                                        color="yellow"
                                        class="ml-1"
                                        v-if="drop.monster.isBoss"
                                        >BOSS</MyBadge
                                    >
                                    <MyBadge class="ml-1">{{ drop.chance }}%</MyBadge>
                                </div>
                            </div>
                            <div v-if="equipment.crafting !== null">
                                <div v-if="equipment.crafting.map !== null">
                                    Crafted in
                                    <Link :href="'/maps/' + equipment.crafting.map.Slug || '-'">{{
                                        equipment.crafting.map.DisplayName
                                    }}</Link>
                                    (Lv {{ equipment.crafting.map.MonsterMinLevel }} -
                                    {{ equipment.crafting.map.MonsterMaxLevel }})
                                </div>
                                <div
                                    v-for="material in equipment.crafting.materials"
                                    :key="material.Slug"
                                >
                                    {{ material.count }} x
                                    <Link :href="'/materials/' + material.item.Slug">{{
                                        material.item.DisplayName
                                    }}</Link>
                                </div>
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
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import { Input } from '@/components/ui/input';
import MyBadge from '@/components/shared/MyBadge.vue';
import MySelect from '@/components/shared/MySelect.vue';
import { Equipment } from '@/types';

const props = defineProps<{
    type: string;
    typeOptions: string[];
    search: string;
    equipmentList: Array<Equipment>;
}>();

const equipmentList = ref(props.equipmentList);
equipmentList.value = equipmentList.value.sort((e1, e2) => e1.DisplayName.localeCompare(e2.DisplayName));

const optionsType = [{ value: 'All', label: 'All (Type)' }];
props.typeOptions.forEach((type) => optionsType.push({ value: type, label: type }));

const filterType = ref(props.type);
const filterText = ref(props.search);

const filteredEquipmentList = computed(() => {
    let filteredEquipmentList = equipmentList.value;

    if (filterType.value !== 'All') {
        filteredEquipmentList = filteredEquipmentList.filter((e) => e.typeName === filterType.value);
    }

    if (filterText.value !== '') {
        filteredEquipmentList = filteredEquipmentList.filter((e) => {
            if (e.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            if (e.typeName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in e.statsPrimary) {
                const stat = e.statsPrimary[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }
            for (const key in e.statsSecondary) {
                const stat = e.statsSecondary[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredEquipmentList;
});

const updateUrl = () => {
    const searchParams = new URLSearchParams();
    if (filterType.value !== 'All') {
        searchParams.set('type', filterType.value);
    }
    if (filterText.value.trim() !== '') {
        searchParams.set('search', filterText.value.trim());
    }
    const query = searchParams.toString();
    if (query.length > 0) {
        window.history.replaceState(null, '', '/equipment?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/equipment');
    }
};
</script>

<style scoped></style>
