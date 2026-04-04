<template>
    <Head title="Cards - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Cards</h1>

        <div class="filter-row">
            <MySelect
                :options="optionsSlot"
                placeholder="Slot"
                v-model="filterSlot"
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

        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th class="left">Card</th>
                        <th class="left">Stats</th>
                        <th class="left">Affix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="card in filteredCards"
                        :key="card.Slug"
                    >
                        <td style="width: 100px">
                            <img
                                style="width: 64px"
                                :src="'https://spiritvale.info/content/game/icons/' + card.icon + '.webp'"
                                :alt="card.DisplayName"
                            />
                        </td>
                        <td>
                            <Link
                                :href="'/cards/' + card.Slug"
                                v-tippy="{ contentLazy: { type: 'card', slug: card.Slug } }"
                                >{{ card.DisplayName }}</Link
                            >
                            <div class="my-2">
                                <MyBadge>{{ card.slot }}</MyBadge>
                            </div>
                        </td>
                        <td>
                            <div
                                v-for="stat in card.stats"
                                v-html="stat"
                            ></div>
                        </td>
                        <td>{{ card.Affix }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { computed, ref, h } from 'vue';
import { Input } from '@/components/ui/input';
import MyBadge from '@/components/shared/MyBadge.vue';
import MySelect from '@/components/shared/MySelect.vue';
import { Card } from '@/types';

const props = defineProps<{
    slot: string;
    type: string;
    search: string;
    cards: Array<Card>;
}>();

const optionsSlot = [
    { value: 'All', label: 'All (Slot)' },
    { value: 'Accessory', label: 'Accessory' },
    { value: 'Chest', label: 'Chest' },
    { value: 'Face', label: 'Face' },
    { value: 'Headgear', label: 'Headgear' },
    { value: 'Legwear', label: 'Legwear' },
    { value: 'Shield', label: 'Shield' },
    { value: 'Shoes', label: 'Shoes' },
    { value: 'Utility', label: 'Utility' },
    { value: 'Weapon', label: 'Weapon' },
];

const optionsType = [
    { value: 'All', label: 'All (Type)' },
    { value: 'Boss', label: 'Boss' },
    { value: 'Normal', label: 'Normal' },
];

const filterSlot = ref(props.slot);
const filterType = ref(props.type);

const cards = ref(props.cards);
cards.value = cards.value.sort((c1, c2) => c1.DisplayName.localeCompare(c2.DisplayName));

const filterText = ref(props.search);

const filteredCards = computed(() => {
    let filteredCards = cards.value;

    if (filterSlot.value !== 'All') {
        filteredCards = filteredCards.filter((c) => c.slot === filterSlot.value);
    }

    if (filterType.value !== 'All') {
        filteredCards = filteredCards.filter((c) => c.IsBoss === (filterType.value === 'Boss' ? 1 : 0));
    }

    if (filterText.value !== '') {
        filteredCards = filteredCards.filter((c) => {
            if (c.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            if (c.Affix.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in c.stats) {
                const stat = c.stats[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredCards;
});

const updateUrl = () => {
    const searchParams = new URLSearchParams();
    if (filterSlot.value !== 'All') {
        searchParams.set('slot', filterSlot.value);
    }
    if (filterType.value !== 'All') {
        searchParams.set('type', filterType.value);
    }
    if (filterText.value.trim() !== '') {
        searchParams.set('search', filterText.value.trim());
    }
    const query = searchParams.toString();
    if (query.length > 0) {
        window.history.replaceState(null, '', '/cards?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/cards');
    }
};
</script>

<style scoped></style>
