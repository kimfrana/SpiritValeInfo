<template>
    <BaseLayout>
        <Head title="Vending - SpiritVale Info"></Head>
        <h1 class="page-title">Vending</h1>

        <Deferred data="vending">
            <template #fallback>
                <div>Loading...</div>
            </template>

            <div style="display: flex; gap: 1rem">
                <select
                    v-model="filterType"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option value="all">All</option>
                    <option value="materials">Materials</option>
                    <option value="consumables">Consumables</option>
                    <option value="equipment">Equipment</option>
                    <option value="cards">Cards</option>
                    <option value="gems">Gems</option>
                </select>

                <select
                    v-model="selectedMaterial"
                    v-if="filterType === 'materials'"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option
                        value=""
                        selected
                    >
                        Please Select
                    </option>
                    <option
                        :value="material.name"
                        v-for="material in vending?.materialsSold"
                        :key="material.name"
                    >
                        {{ material.name }} ({{ material.count }})
                    </option>
                </select>
                <select
                    v-model="selectedConsumable"
                    v-if="filterType === 'consumables'"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option
                        value=""
                        selected
                    >
                        Please Select
                    </option>
                    <option
                        :value="consumable.name"
                        v-for="consumable in vending?.consumablesSold"
                        :key="consumable.name"
                    >
                        {{ consumable.name }} ({{ consumable.count }})
                    </option>
                </select>
                <select
                    v-model="selectedEquipment"
                    v-if="filterType === 'equipment'"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option
                        value=""
                        selected
                    >
                        Please Select
                    </option>
                    <option
                        :value="equipment.name"
                        v-for="equipment in vending?.equipmentsSold"
                        :key="equipment.name"
                    >
                        {{ equipment.name }} ({{ equipment.count }})
                    </option>
                </select>
                <select
                    v-model="selectedCard"
                    v-if="filterType === 'cards'"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option
                        value=""
                        selected
                    >
                        Please Select
                    </option>
                    <option
                        :value="card.name"
                        v-for="card in vending?.cardsSold"
                        :key="card.name"
                    >
                        {{ card.name }} ({{ card.count }})
                    </option>
                </select>
                <select
                    v-model="selectedGem"
                    v-if="filterType === 'gems'"
                    style="width: 300px"
                    class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
                >
                    <option
                        value=""
                        selected
                    >
                        Please Select
                    </option>
                    <option
                        :value="gem.name"
                        v-for="gem in vending?.gemsSold"
                        :key="gem.name"
                    >
                        {{ gem.name }} ({{ gem.count }})
                    </option>
                </select>
            </div>

            <div
                class="data-table"
                style="max-width: 600px; margin: 0 auto; margin-top: 2rem"
            >
                <table>
                    <thead>
                        <tr>
                            <th>Shop</th>
                            <th>Map</th>
                            <th>Server</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="shop in sortedShops"
                            :key="shop.characterName"
                        >
                            <td class="center">
                                <div>{{ shop.name }} ({{ shop.characterName }})</div>
                                <div v-if="shop.itemInfo">
                                    {{ shop.itemInfo.count }} x
                                    <span v-if="shop.itemInfo.refine">+{{ shop.itemInfo.refine }}</span>
                                    {{ Intl.NumberFormat('en-US').format(shop.itemInfo.price) }}
                                </div>
                            </td>
                            <td class="center">{{ shop.map }}</td>
                            <td class="center">{{ shop.server }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </Deferred>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Deferred, Head, router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';

const props = defineProps<{
    filterType: string;
    filterName: string;
    vending?: {
        shops: Array<{
            name: string;
            server: string;
            map: string;
            characterName: string;
            itemInfo: null | { count: number; price: number; refine?: number };
        }>;
        materialsSold: Array<{ name: string; count: number }>;
        consumablesSold: Array<{ name: string; count: number }>;
        equipmentsSold: Array<{ name: string; count: number }>;
        cardsSold: Array<{ name: string; count: number }>;
        gemsSold: Array<{ name: string; count: number }>;
    };
}>();

const filterType = ref(props.filterType);
const selectedMaterial = ref(filterType.value === 'materials' ? props.filterName : '');
const selectedConsumable = ref(filterType.value === 'consumables' ? props.filterName : '');
const selectedEquipment = ref(filterType.value === 'equipment' ? props.filterName : '');
const selectedCard = ref(filterType.value === 'cards' ? props.filterName : '');
const selectedGem = ref(filterType.value === 'gems' ? props.filterName : '');

//const sortedShops = props.shops.sort((a, b) => a.name.localeCompare(b.name));
const sortedShops = computed(() => {
    if (!props.vending?.shops) {
        return [];
    }

    const shops = props.vending.shops;
    return shops.sort((a, b) => a.name.localeCompare(b.name));
});

watch(selectedMaterial, () => {
    if (selectedMaterial.value !== '') {
        const searchParams = new URLSearchParams();
        searchParams.set('filterType', 'materials');
        searchParams.set('filterName', selectedMaterial.value);

        const query = searchParams.toString();

        router.get('?' + query);
    }
});

watch(selectedConsumable, () => {
    if (selectedConsumable.value !== '') {
        const searchParams = new URLSearchParams();
        searchParams.set('filterType', 'consumables');
        searchParams.set('filterName', selectedConsumable.value);

        const query = searchParams.toString();

        router.get('?' + query);
    }
});

watch(selectedEquipment, () => {
    if (selectedEquipment.value !== '') {
        const searchParams = new URLSearchParams();
        searchParams.set('filterType', 'equipment');
        searchParams.set('filterName', selectedEquipment.value);

        const query = searchParams.toString();

        router.get('?' + query);
    }
});

watch(selectedCard, () => {
    if (selectedCard.value !== '') {
        const searchParams = new URLSearchParams();
        searchParams.set('filterType', 'cards');
        searchParams.set('filterName', selectedCard.value);

        const query = searchParams.toString();

        router.get('?' + query);
    }
});

watch(selectedGem, () => {
    if (selectedGem.value !== '') {
        const searchParams = new URLSearchParams();
        searchParams.set('filterType', 'gems');
        searchParams.set('filterName', selectedGem.value);

        const query = searchParams.toString();

        router.get('?' + query);
    }
});
</script>

<style scoped></style>
