<template>
    <Head title="Gems - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Gems</h1>

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
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th class="left">Gem</th>
                        <th class="left">Stats</th>
                        <th class="left">Affix</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="gem in filteredGems"
                        :key="gem.Slug"
                    >
                        <td style="width: 100px">
                            <img
                                style="width: 64px"
                                :src="'https://spiritvale.info/content/game/icons/' + gem.icon + '.webp'"
                                :alt="gem.DisplayName"
                            />
                        </td>
                        <td>
                            <Link
                                :href="'/gems/' + gem.Slug"
                                v-tippy="{ contentLazy: { type: 'gem', slug: gem.Slug } }"
                                >{{ gem.DisplayName }}</Link
                            >
                        </td>
                        <td>
                            <div
                                v-for="stat in gem.statsTexts"
                                v-html="stat"
                            ></div>
                        </td>
                        <td>{{ gem.Affix }}</td>
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
import { Card, Gem } from '@/types';

const props = defineProps<{
    type: string;
    search: string;
    gems: Array<Gem>;
}>();

const optionsType = [
    { value: 'All', label: 'All (Type)' },
    { value: 'Boss', label: 'Boss' },
    { value: 'Skill', label: 'Skill' },
];

const filterType = ref(props.type);

const gems = ref(props.gems);
gems.value = gems.value.sort((g1, g2) => g1.DisplayName.localeCompare(g2.DisplayName));

const filterText = ref(props.search);

const filteredGems = computed(() => {
    let filteredGems = gems.value;

    if (filterType.value !== 'All') {
        filteredGems = filteredGems.filter((g) => g.IsBoss === (filterType.value === 'Boss' ? 1 : 0));
    }

    if (filterText.value !== '') {
        filteredGems = filteredGems.filter((g) => {
            if (g.DisplayName.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            if (g.Affix.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in g.statsTexts) {
                const stat = g.statsTexts[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredGems;
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
        window.history.replaceState(null, '', '/gems?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/gems');
    }
};
</script>

<style scoped></style>
