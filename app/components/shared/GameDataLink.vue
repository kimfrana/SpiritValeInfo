
<template>
    <Link
        :href="getBaseLink(type) + '/' + gameData.Slug"
        v-tippy="{ contentLazy: { type: type, slug: slug } }"
        v-if="gameData"
    >
        <img
            style="height: 1.2rem; display: inline; margin-right: -0.25rem;"
            :src="'https://spiritvale.info/content/game/icons/' + getIconPrefix(type) + gameData.icon + '.webp'"
            :alt="gameData.DisplayName"
            v-if="showIcon && getIconPrefix(type) !== null"
        />
        {{ gameData.DisplayName }}
    </Link>
    <span v-else>INVALID-LINK-{{type}}-{{slug}}</span>
</template>

<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { GameDataType } from '@/types';

const props = withDefaults(defineProps<{
    type: GameDataType;
    slug: string;
    showIcon?: boolean;
}>(), {
    showIcon: true,
});

const page = usePage();
const gameDataByType = page.props.gameData?.[props.type];
const gameData = gameDataByType?.find((m: any) => m.Slug === props.slug);

const getBaseLink = (type: GameDataType): string => {
    switch (type) {
        case 'card':
            return '/cards';
        default:
            return '';
    }
}

const getIconPrefix = (type: GameDataType): string|null => {
    switch (type) {
        case 'card':
            return '';
        case 'equipment':
        case 'material':
        case 'consumable':
            return 'item-';
        case 'monster':
            return null;
        default:
            return '';
    }
}
</script>

<style scoped>

</style>