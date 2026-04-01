<template>
    <Teleport to="body">
        <div
            id="tooltip-container-lazy"
            class="hidden"
        >
            <TooltipCard
                v-if="tooltipStore.type === 'card'"
                :card="tooltipStore.data"
            />
            <TooltipGem
                v-if="tooltipStore.type === 'gem'"
                :gem="tooltipStore.data"
            />
            <TooltipConsumable
                v-if="tooltipStore.type === 'consumable'"
                :consumable="tooltipStore.data"
            />
            <TooltipEquipment
                v-if="tooltipStore.type === 'equipment'"
                :equipment="tooltipStore.data"
            />
            <TooltipMaterial
                v-if="tooltipStore.type === 'material'"
                :material="tooltipStore.data"
            />
            <TooltipMonster
                v-if="tooltipStore.type === 'monster'"
                :monster="tooltipStore.data"
            />
            <TooltipSkill
                v-if="tooltipStore.type === 'skill'"
                :skill="tooltipStore.data"
            />
        </div>
    </Teleport>
</template>

<script setup lang="ts">
import { Teleport } from 'vue';
import { useTooltipStore } from '@/stores/tooltip';
import TooltipCard from '@/components/shared/TooltipCard.vue';
import TooltipConsumable from '@/components/shared/TooltipConsumable.vue';
import TooltipEquipment from '@/components/shared/TooltipEquipment.vue';
import TooltipGem from '@/components/shared/TooltipGem.vue';
import TooltipMaterial from '@/components/shared/TooltipMaterial.vue';
import TooltipMonster from '@/components/shared/TooltipMonster.vue';
import TooltipSkill from '@/components/shared/TooltipSkill.vue';

const tooltipStore = useTooltipStore();
</script>