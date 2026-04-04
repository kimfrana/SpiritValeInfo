<template>
    <BaseLayout>
        <Head title="Build Simulator - SpiritVale Info"></Head>
        <h1 class="page-title">Build Simulator</h1>

        <div v-if="selectedClass === null">
            <div class="text-left">
                <template v-for="c in classes">
                    <div
                        class="cursor-pointer text-left p-4"
                        style="display: inline-block"
                        v-if="baseClasses.includes(c.DisplayName) || c.DisplayName === 'Weaver'"
                        :key="c.GameId"
                        @click="selectClass(c.DisplayName)"
                    >
                        <img
                            style="width: 64px; display: inline-block"
                            :src="'https://spiritvale.info/content/game/icons/' + c.icon + '.webp'"
                            :alt="c.DisplayName"
                            v-if="c.icon"
                        />
                        <div class="mt-2">{{ c.DisplayName }}</div>
                    </div>
                </template>

                <p>
                    More information about each class can be found in the
                    <a
                        href="https://spiritvale.info/wiki/Classes"
                        target="_blank"
                        >Wiki</a
                    >.
                </p>
            </div>
        </div>
        <div v-else>
            <h1
                style="text-align: left"
                class="mb-4"
            >
                Skill Tree
            </h1>
            <div
                style="text-align: left"
                class="mb-4"
            >
                <button
                    class="reset-button p-2 rounded-md ml-2"
                    @click="changeClass"
                >
                    Change Class
                </button>
            </div>
            <SkillTreeView
                :skill-tree="skillTree"
                :skill-map="skillMap"
                :job-level="jobLevel"
                :editable="true"
                v-model:skill-levels="skillLevels"
            ></SkillTreeView>
            <div style="height: 8rem"></div>
            <SkillTreeView
                :skill-tree="skillTreeAdvanced"
                :skill-map="skillMap"
                :job-level="70"
                :editable="true"
                v-model:skill-levels="skillLevelsAdvanced"
                v-if="skillTreeAdvanced"
            ></SkillTreeView>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { computed, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import SkillTreeView from '@/components/shared/SkillTreeView.vue';

const props = defineProps<{
    classes: Array<{ name: string }>;
    classSkillTrees: any;
    skills: any;
    skillMap: any;
}>();

const baseClasses = [
    'Acolyte',
    'Knight',
    'Mage',
    'Rogue',
    'Scout',
    'Summoner',
    'Warrior',
    'Weaver',
];

const selectedClass = ref<string | null>(null);

const skillTree = ref<any>(null);
const skillTreeAdvanced = ref<any>(null);

const jobLevel = ref<number>(70);

const skillLevels = ref({});
const skillLevelsAdvanced = ref({});

const changeClass = () => {
    selectedClass.value = null;
    skillTreeAdvanced.value = null;
};

const resetSkillPoints = () => {
    props.skills.forEach((skill) => {
        skillLevels.value[skill.id] = 0;
    });
    props.skills.forEach((skill) => {
        skillLevelsAdvanced.value[skill.id] = 0;
    });
};

resetSkillPoints();

const selectClass = (classId: string) => {
    selectedClass.value = classId;
    skillTree.value = props.classSkillTrees[classId];
    if (classId === 'Mage') {
        skillTreeAdvanced.value = props.classSkillTrees['Wizard'];
    }
    if (classId === 'Rogue') {
        skillTreeAdvanced.value = props.classSkillTrees['Shinobi'];
    }
    if (classId === 'Acolyte') {
        skillTreeAdvanced.value = props.classSkillTrees['Priest'];
    }
    if (classId === 'Knight') {
        skillTreeAdvanced.value = props.classSkillTrees['Paladin'];
    }
    if (classId === 'Scout') {
        skillTreeAdvanced.value = props.classSkillTrees['Gunslinger'];
    }
    if (classId === 'Summoner') {
        skillTreeAdvanced.value = props.classSkillTrees['Necromancer'];
    }
    if (classId === 'Warrior') {
        skillTreeAdvanced.value = props.classSkillTrees['Berserker'];
    }

    const sClass = props.classes.find((c) => c.name === classId);
    if (sClass) {
        jobLevel.value = sClass.MaxJobLevel;

        resetSkillPoints();
    } else {
        console.error('unknown class ' + classId);
    }
};
</script>

<style scoped>
.reset-button {
    background-color: #304876;
    cursor: pointer;
}

.skill-level-button {
    padding: 0.25rem 0.5rem;
    background-color: #304876;
    cursor: pointer;
    border-radius: 0.25rem;
}

.skill-level-button:disabled {
    cursor: not-allowed;
    background-color: #192640;
}
</style>
