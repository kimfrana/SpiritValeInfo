<template>
    <BaseLayout>
        <h1 class="page-title">Leaderboards</h1>

        <select
            v-model="type"
            style="width: 300px"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 placeholder-gray-400"
        >
            <option v-for="option in types">{{ option }}</option>
        </select>

        <div class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Character</th>
                        <th>Level</th>
                        <th v-if="type === 'All'">Class</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(entry, i) in levelLeaderboards[type]"
                        :key="entry.slug"
                    >
                        <td class="center">{{ i + 1 }}</td>
                        <td class="center">
                            <Link :href="'/game/characters/' + entry.slug">{{ entry.name }}</Link>
                        </td>
                        <td class="center">{{ entry.level }}</td>
                        <td
                            v-if="type === 'All'"
                            class="center"
                        >
                            {{ entry.advancedClass ?? entry.class }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

type LeaderBoardEntry = {
    name: string;
    class: string;
    level: string;
    jobLevel: string;
    maxLevelDate: string | null;
    slug: string;
};

defineProps<{
    //levelLeaderboards: {[key: value] LeaderBoardEntry[]};
    levelLeaderboards: any;
}>();

const types = ['All', 'Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'];

const type = ref('All');
</script>

<style scoped></style>
