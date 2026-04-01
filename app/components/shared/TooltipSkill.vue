<template>
    <div>
        <div style="display: flex; flex-direction: row; gap: 1rem">
            <div>
                <img
                    :src="'https://spiritvale.info/content/game/icons/skill-' + skill.id + '.webp'"
                    :alt="skill.name"
                    style="width: 100px; display: inline"
                />
            </div>
            <div>
                <div
                    v-if="!skill.isPassive"
                    style="color: #ffe100"
                    class="font-bold"
                >
                    Active
                </div>
                <div
                    style="color: #67a4ff"
                    class="font-bold"
                    v-else
                >
                    Passive
                </div>
                <div>
                    <span
                        class="text-2xl font-bold"
                        style="color: #ffffff"
                        >{{ skill.name }}</span
                    >
                </div>
                <div>
                    <span
                        class="text-lg font-bold"
                        style="color: white; text-transform: uppercase"
                        >Max Level {{ skill.maxLevel }}</span
                    >
                </div>
            </div>
        </div>

        <!--<div><span class="text-lg font-bold" :style="{'color': getElementColor(skill.element) }">{{ skill.element }}</span></div>-->
        <div
            class="mt-4"
            style="color: white"
        >
            {{ skill.description }}
        </div>

        <div class="mt-4 font-bold">
            <div v-if="skill.values">
                <div v-if="skill.values.damage">
                    Damage:
                    <span v-if="skill.values.damage.base">{{ skill.values.damage.base }}%</span>
                    <span v-if="skill.values.damage.level"> + {{ skill.values.damage.level }}% per level</span>
                    <span
                        v-for="scaling in skill.values.damage.scaling"
                        :key="scaling.type"
                    >
                        + {{ scaling.value }}% per {{ scaling.type }}</span
                    >
                </div>
                <div v-if="skill.values.cooldown && skill.values.cooldown.base + skill.values.cooldown.level > 0">
                    Cooldown: {{ skill.values.cooldown.base }} seconds
                </div>
                <div v-if="skill.values.cost">
                    Cost: {{ skill.values.cost.base
                    }}<span v-if="skill.values.cost.level"> + {{ skill.values.cost.level }} mana per level</span
                    ><span v-else> mana</span>
                </div>
            </div>
        </div>

        <div
            class="pt-2"
            v-if="skill.requirements.length > 0"
        >
            <div
                class="font-bold"
                style="color: #ffe100"
                v-for="requiredSkill in skill.requirements"
                :key="requiredSkill.name"
            >
                Requires {{ requiredSkill.name }} Lv.{{ requiredSkill.level }}
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { getElementColor } from '@/services/util';
import MyBadge from '@/components/shared/MyBadge.vue';
import ElementDamageInfo from '@/components/shared/ElementDamageInfo.vue';
import { GameElement } from '@/types';

defineProps<{
    skill: {
        id: string;
        name: string;
        maxLevel: number;
        isPassive: boolean;
        description: string;
        //element: GameElement;
    };
}>();
</script>

<style scoped></style>
