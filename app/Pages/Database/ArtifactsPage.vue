<template>
    <Head title="Artifacts - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Artifacts</h1>
        <p
            style="text-align: left"
            class="mt-2 mb-4"
        >
            More information can be found on the
            <a
                href="https://spiritvale.info/wiki/Artifacts"
                target="_blank"
                >Artifacts</a
            >
            wiki page.
        </p>

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
                        <th class="left">Artifacts</th>
                        <th class="left">Stats</th>
                        <th class="left">Obtained</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="artifact in filteredArtifacts"
                        :key="artifact.name"
                    >
                        <td>
                            {{ artifact.name }}
                            <div v-if="artifact.maps.length > 0">
                                <div
                                    v-for="map in artifact.maps"
                                    :key="map.slug"
                                >
                                    <Link :href="'/maps/' + map.slug">{{ map.name }}</Link> (Lv {{ map.minLevel }} -
                                    {{ map.maxLevel }})
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="color: #c9ae01; font-weight: bold">Per Piece:</div>
                            <div
                                v-for="stat in artifact.statsPerPiece"
                                v-html="stat"
                            ></div>
                            <div style="color: #c9ae01; font-weight: bold">Full Set:</div>
                            <div
                                v-for="stat in artifact.statsFullSet"
                                v-html="stat"
                            ></div>
                            <div style="color: #c9ae01; font-weight: bold">Per Refine:</div>
                            <div
                                v-for="stat in artifact.statsPerRefine"
                                v-html="stat"
                            ></div>
                        </td>
                        <td>
                            <div
                                class="my-2"
                                v-for="drop in artifact.drops"
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

const props = defineProps<{
    search: string;
    artifacts: Array<{
        name: string;
        statsFullSet: string[];
        statsPerPiece: string[];
        statsPerRefine: string[];
        maps: object[];
        drops: Array<{ monster: { name: string; isBoss: boolean; level: number; slug: string }; chance: number }>;
    }>;
}>();

const artifacts = ref(props.artifacts);
artifacts.value = artifacts.value.sort((a1, a2) => a1.name.localeCompare(a2.name));

const filterText = ref(props.search);

const filteredArtifacts = computed(() => {
    let filteredArtifacts = artifacts.value;

    if (filterText.value !== '') {
        filteredArtifacts = filteredArtifacts.filter((a) => {
            if (a.name.toLowerCase().includes(filterText.value.toLowerCase())) {
                return true;
            }

            for (const key in a.statsFullSet) {
                const stat = a.statsFullSet[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            for (const key in a.statsPerPiece) {
                const stat = a.statsPerPiece[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            for (const key in a.statsPerRefine) {
                const stat = a.statsPerRefine[key];
                if (stat.toLowerCase().includes(filterText.value.toLowerCase())) {
                    return true;
                }
            }

            return false;
        });
    }

    return filteredArtifacts;
});

const updateUrl = () => {
    const searchParams = new URLSearchParams();
    if (filterText.value.trim() !== '') {
        searchParams.set('search', filterText.value.trim());
    }
    const query = searchParams.toString();
    if (query.length > 0) {
        window.history.replaceState(null, '', '/artifacts?' + query);
    } else if (window.location.search.length > 0) {
        window.history.replaceState(null, '', '/artifacts');
    }
};
</script>

<style scoped></style>
