<template>
    <BaseLayout>
        <Head :title="character.name + ' - SpiritVale Info'"></Head>
        <h1 class="page-title">{{ character.name }}</h1>
        <p style="text-align: left">
            Level {{ character.level }} / {{ character.jobLevel }} {{ character.advancedClass ?? character.class }}
        </p>

        <h2 class="mt-8">Stats</h2>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>STR</th>
                        <th>AGI</th>
                        <th>DEX</th>
                        <th>INT</th>
                        <th>VIT</th>
                        <th>LUK</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="center">{{ character.attributes.STR }}</td>
                        <td class="center">{{ character.attributes.AGI }}</td>
                        <td class="center">{{ character.attributes.DEX }}</td>
                        <td class="center">{{ character.attributes.INT }}</td>
                        <td class="center">{{ character.attributes.VIT }}</td>
                        <td class="center">{{ character.attributes.LUK }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="mt-8">Equipment</h2>
        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Cards</th>
                        <th>Bonus Stats</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="equip in character.equipList"
                        :key="equip.slug"
                    >
                        <td
                            class="center"
                            v-if="equip.item"
                        >
                            <img
                                style="height: 2rem; display: inline; vertical-align: middle; margin-right: 0.5rem"
                                :src="'https://spiritvale.info/content/game/icons/item-' + equip.item.icon + '.webp'"
                                :alt="equip.item.name"
                            />
                            <span v-if="equip.refineLevel > 0">+{{ equip.refineLevel }}{{ ' ' }}</span>
                            <span v-if="equip.affixes.length > 0">{{ affixesToString(equip.affixes) }}{{ ' ' }}</span>
                            <Link
                                :href="'/equipment/' + equip.item.slug"
                                v-tippy="{ contentLazy: { type: 'equipment', data: equip.item } }"
                                >{{ equip.item?.name }}</Link
                            >
                        </td>
                        <td
                            class="center"
                            v-else
                        >
                            ?
                        </td>
                        <td class="center">
                            <div v-for="card in equip.cards">
                                <img
                                    style="height: 2rem; display: inline; vertical-align: middle; margin-right: 0.5rem"
                                    :src="'https://spiritvale.info/content/game/icons/' + card.icon + '.webp'"
                                    :alt="card.name"
                                />
                                <Link
                                    :href="'/cards/' + card.slug"
                                    v-tippy="{ contentLazy: { type: card, data: card } }"
                                    >{{ card.name }}</Link
                                >
                            </div>
                        </td>
                        <td class="center"><span style="font-style: italic">Not Implemented Yet</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="mt-8">Skills</h2>
        <SkillTreeView
            :skill-tree="skillTree"
            :skill-map="skillMap"
            :job-level="character.jobLevel"
            :editable="false"
            v-model:skill-levels="skillLevels"
        ></SkillTreeView>
        <SkillTreeView
            :skill-tree="skillTreeAdvanced"
            :skill-map="skillMap"
            :job-level="character.jobLevel"
            :editable="false"
            v-model:skill-levels="skillLevels"
            v-if="character.advancedClass !== null"
        ></SkillTreeView>
    </BaseLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import SkillTreeView from '@/components/shared/SkillTreeView.vue';

const props = defineProps<{
    character: any;
    cards: any[];
    equipList: any[];
    skills: any[];
    skillTree: any;
    skillTreeAdvanced: any;
    skillMap: any;
    skillLevels: any;
}>();

const skillLevels = ref(props.skillLevels);

const affixesToString = (affixes: string[]): string => {
    return affixes.join(' ');
};
</script>

<style scoped></style>
