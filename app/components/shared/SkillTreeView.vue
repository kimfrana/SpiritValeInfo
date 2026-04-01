<template>
    <div
        style="text-align: center"
        v-if="editable"
    >
        <span class="bg-gray-700 p-2 rounded-md">{{ skillPoints }} skill points</span>
        <button
            class="reset-button p-2 rounded-md ml-2"
            @click="resetSkillPoints()"
        >
            Reset
        </button>
    </div>
    <div
        style="overflow-x: auto"
        v-if="skillTree"
    >
        <table style="width: 100%; text-align: center">
            <tr
                style="vertical-align: middle"
                v-for="row in 6"
            >
                <td
                    style="width: 15%"
                    v-for="col in 7"
                >
                    <div
                        v-if="skillTree[row - 1][col - 1]"
                        class="py-4"
                    >
                        <div>
                            <img
                                :src="'https://spiritvale.info/content/game/icons/skill-' + skillTree[row - 1][col - 1].id + '.webp'"
                                :style="{
                                    width: '64px',
                                    display: 'inline',
                                    'border-radius': skillTree[row - 1][col - 1].isPassive ? '1rem' : '50%',
                                }"
                                v-tippy="{ contentLazy: { type: 'skill', data: skillTree[row - 1][col - 1] } }"
                            />
                        </div>
                        <span
                            class="text-lg font-bold"
                            v-tippy="{ contentLazy: { type: 'skill', data: skillTree[row - 1][col - 1] } }"
                            >{{ skillTree[row - 1][col - 1].name }}</span
                        >
                        <div>
                            <button
                                class="skill-level-button"
                                :disabled="skillLevels[skillTree[row - 1][col - 1].id] === 0"
                                @click="decreaseSkillLevel(skillTree[row - 1][col - 1].id)"
                                v-if="editable"
                            >
                                <svg
                                    class="w-6 h-6 text-white"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12h14"
                                    />
                                </svg>
                            </button>

                            <span style="font-size: 1.25rem; vertical-align: top; margin: 0 0.5rem"
                                >{{ skillLevels[skillTree[row - 1][col - 1].id] }} /
                                {{ skillTree[row - 1][col - 1].maxLevel }}</span
                            >

                            <div
                                style="display: inline-block"
                                v-tippy="getMissingRequirements(skillTree[row - 1][col - 1].id)"
                                v-if="!canBeIncreased(skillTree[row - 1][col - 1].id, row, col)"
                            >
                                <button
                                    class="skill-level-button"
                                    disabled
                                    v-if="editable"
                                >
                                    <svg
                                        class="w-6 h-6 text-white"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 12h14m-7 7V5"
                                        />
                                    </svg>
                                </button>
                            </div>
                            <div
                                style="display: inline-block"
                                v-else
                            >
                                <button
                                    class="skill-level-button"
                                    @click="increaseSkillLevel(skillTree[row - 1][col - 1].id)"
                                    v-if="editable"
                                >
                                    <svg
                                        class="w-6 h-6 text-white"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 12h14m-7 7V5"
                                        />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
    skillTree: any;
    skillMap: any;
    jobLevel: number;
    editable: boolean;
}>();

const skillLevels = defineModel('skillLevels');

const skillPoints = computed(() => {
    let skillPoints = props.jobLevel + 1;

    for (let key in skillLevels.value) {
        skillPoints -= skillLevels.value[key];
    }

    return skillPoints;
});

const increaseSkillLevel = (skillId: string) => {
    if (skillPoints.value < 1 || skillLevels.value[skillId] >= props.skillMap[skillId].maxLevel) {
        return;
    }

    /*for (let key in props.skillMap[skillId].requirements) {
        const requirement = props.skillMap[skillId].requirements[key];
        if (requirement.level > skillLevels.value[requirement.id]) {
            alert(requirement.name + ' Lv ' + requirement.level + ' required!');
            return;
        }
    }*/
    const missingRequirements = getMissingRequirements(skillId);
    if (missingRequirements !== null) {
        alert(missingRequirements);
        return;
    }

    skillLevels.value[skillId]++;
};

const decreaseSkillLevel = (skillId: string) => {
    if (skillLevels.value[skillId] < 1) {
        return;
    }

    for (let row in props.skillTree.value) {
        for (let col in props.skillTree.value[row]) {
            const skill = props.skillTree.value[row][col];
            if (skill === null || skillLevels.value[skill.id] < 1) continue;

            for (let key in skill.requirements) {
                const requirement = skill.requirements[key];
                if (requirement.id === skillId && requirement.level === skillLevels.value[skillId]) {
                    alert('Lv ' + requirement.level + ' required by ' + skill.name + '!');
                    return;
                }
            }
        }
    }

    skillLevels.value[skillId]--;
};

const canBeIncreased = (skillId: string, row: number, col: number) => {
    const result =
        skillLevels.value[skillId] < props.skillTree[row - 1][col - 1].maxLevel &&
        getMissingRequirements(skillId) === null;

    return result;
};

const getMissingRequirements = (skillId: string): string | null => {
    for (let key in props.skillMap[skillId].requirements) {
        const requirement = props.skillMap[skillId].requirements[key];
        if (requirement.level > skillLevels.value[requirement.id]) {
            return requirement.name + ' Lv ' + requirement.level + ' required!';
        }
    }

    return null;
};

const resetSkillPoints = () => {
    for (let row = 0; row < 6; ++row) {
        for (let col = 0; col < 7; ++col) {
            let skill = props.skillTree[row][col];
            if (skill !== null) {
                skillLevels.value[skill.id] = 0;
            }
        }
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
