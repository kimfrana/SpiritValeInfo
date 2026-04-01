<template>
    <BaseLayout>
        <Head title="Game Statistics - SpiritVale Info"></Head>
        <h1 class="page-title">Game Statistics</h1>

        <select
            v-model="selectedLevelClass"
            style="width: 300px"
            class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
        >
            <option
                value="All"
                selected
            >
                All Classes (Sum)
            </option>
            <option
                value="Multi"
                selected
            >
                All Classes (Single)
            </option>
            <option value="Acolyte">Acolyte</option>
            <option value="Knight">Knight</option>
            <option value="Mage">Mage</option>
            <option value="Rogue">Rogue</option>
            <option value="Scout">Scout</option>
            <option value="Summoner">Summoner</option>
            <option value="Warrior">Warrior</option>
        </select>
        <div
            style="width: 100%; height: 500px"
            v-if="levels.length > 0"
        >
            <Line
                :data="data['All']"
                :options="options"
                v-if="selectedLevelClass === 'All'"
            />
            <Line
                :data="dataMulti"
                :options="options"
                v-if="selectedLevelClass === 'Multi'"
            />
            <Line
                :data="data['Acolyte']"
                :options="options"
                v-if="selectedLevelClass === 'Acolyte'"
            />
            <Line
                :data="data['Knight']"
                :options="options"
                v-if="selectedLevelClass === 'Knight'"
            />
            <Line
                :data="data['Mage']"
                :options="options"
                v-if="selectedLevelClass === 'Mage'"
            />
            <Line
                :data="data['Rogue']"
                :options="options"
                v-if="selectedLevelClass === 'Rogue'"
            />
            <Line
                :data="data['Scout']"
                :options="options"
                v-if="selectedLevelClass === 'Scout'"
            />
            <Line
                :data="data['Summoner']"
                :options="options"
                v-if="selectedLevelClass === 'Summoner'"
            />
            <Line
                :data="data['Warrior']"
                :options="options"
                v-if="selectedLevelClass === 'Warrior'"
            />
        </div>

        <div
            class="mt-8"
            style="height: 500px"
        >
            <select
                v-model="classesLevels"
                style="width: 300px"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5"
            >
                <option
                    value="all"
                    selected
                >
                    All Levels
                </option>
                <option
                    value="low"
                    selected
                >
                    1 - 50
                </option>
                <option
                    value="mid"
                    selected
                >
                    51 - 100
                </option>
                <option
                    value="high"
                    selected
                >
                    101 - 150
                </option>
            </select>
            <template v-if="props.classes.all">
                <Pie
                    :data="classesData['all']"
                    :options="classesOptions"
                    v-if="classesLevels === 'all'"
                ></Pie>
                <Pie
                    :data="classesData['low']"
                    :options="classesOptions"
                    v-if="classesLevels === 'low'"
                ></Pie>
                <Pie
                    :data="classesData['mid']"
                    :options="classesOptions"
                    v-if="classesLevels === 'mid'"
                ></Pie>
                <Pie
                    :data="classesData['high']"
                    :options="classesOptions"
                    v-if="classesLevels === 'high'"
                ></Pie>
            </template>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Deferred, Head } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

import {
    Chart as ChartJS,
    CategoryScale,
    LinearScale,
    PointElement,
    LineElement,
    Title,
    Tooltip,
    Legend,
    ArcElement,
} from 'chart.js';
import { Line, Pie } from 'vue-chartjs';

const props = defineProps<{
    levels: any;
    classes: any;
}>();

ChartJS.register(CategoryScale, LinearScale, PointElement, LineElement, Title, Tooltip, Legend, ArcElement);

const selectedLevelClass = ref('All');

const isDarkMode = () => window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;

const darkModeActive = isDarkMode();

const gridColor = computed(() => {
    return darkModeActive ? 'oklch(55.1% 0.027 264.364)' : 'oklch(55.1% 0.027 264.364)';
});

const classList = ['All', 'Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'];
let levelData = {};
let data = {};
let dataMulti = {
    datasets: [],
};

const colors = {
    All: { c1: 'oklch(62.3% 0.214 259.815)', c2: 'oklch(80.9% 0.105 251.813)' },
    Acolyte: { c1: 'oklch(70.5% 0.213 47.604)', c2: 'oklch(83.7% 0.128 66.29)' },
    Knight: { c1: 'oklch(76.8% 0.233 130.85)', c2: 'oklch(89.7% 0.196 126.665)' },
    Mage: { c1: 'oklch(69.6% 0.17 162.48)', c2: 'oklch(84.5% 0.143 164.978)' },
    Rogue: { c1: 'oklch(71.5% 0.143 215.221)', c2: 'oklch(86.5% 0.127 207.078)' },
    Scout: { c1: 'oklch(58.5% 0.233 277.117)', c2: 'oklch(78.5% 0.115 274.713)' },
    Summoner: { c1: 'oklch(66.7% 0.295 322.15)', c2: 'oklch(83.3% 0.145 321.434)' },
    Warrior: { c1: 'oklch(64.5% 0.246 16.439)', c2: 'oklch(81% 0.117 11.638)' },
};

if (props.levels.length > 0) {
    for (let c of classList) {
        let d = [];
        for (let i = 1; i < props.levels[c].length; i++) {
            d.push({ x: i + 1, y: props.levels[c][i] });
        }
        levelData = d;

        data[c] = {
            datasets: [
                {
                    label: 'Characters',
                    data: levelData,
                    borderColor: colors[c].c1,
                    backgroundColor: colors[c].c2,
                    tension: 0.3,
                },
            ],
        };

        if (c !== 'All') {
            dataMulti.datasets.push({
                label: c,
                data: levelData,
                borderColor: colors[c].c1,
                backgroundColor: colors[c].c2,
                tension: 0.3,
            });
        }
    }
}

const options = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: {
            type: 'linear',
            min: 1,
            max: 150,
            ticks: {
                stepSize: 10,
                color: gridColor.value,
            },
            grid: {
                color: gridColor.value,
            },
            title: {
                display: true,
                text: 'Level (1–150)',
                color: gridColor.value,
            },
        },
        y: {
            beginAtZero: true,
            ticks: {
                color: gridColor.value,
            },
            grid: {
                color: gridColor.value,
            },
            /*title: {
        display: true,
        text: "Number of Characters"
      }*/
        },
    },
};

const classesLevels = ref('all');

const classesData = [];
if (props.classes.all) {
    classesData['all'] = {
        labels: ['Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'],
        datasets: [
            {
                label: 'Characters',
                data: [
                    props.classes.all.Acolyte,
                    props.classes.all.Knight,
                    props.classes.all.Mage,
                    props.classes.all.Rogue,
                    props.classes.all.Scout,
                    props.classes.all.Summoner,
                    props.classes.all.Warrior,
                ],
                backgroundColor: [
                    colors.Acolyte.c1,
                    colors.Knight.c1,
                    colors.Mage.c1,
                    colors.Rogue.c1,
                    colors.Scout.c1,
                    colors.Summoner.c1,
                    colors.Warrior.c1,
                ],
            },
        ],
    };
    classesData['low'] = {
        labels: ['Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'],
        datasets: [
            {
                label: 'Characters',
                data: [
                    props.classes.low.Acolyte,
                    props.classes.low.Knight,
                    props.classes.low.Mage,
                    props.classes.low.Rogue,
                    props.classes.low.Scout,
                    props.classes.low.Summoner,
                    props.classes.low.Warrior,
                ],
                backgroundColor: [
                    colors.Acolyte.c1,
                    colors.Knight.c1,
                    colors.Mage.c1,
                    colors.Rogue.c1,
                    colors.Scout.c1,
                    colors.Summoner.c1,
                    colors.Warrior.c1,
                ],
            },
        ],
    };
    classesData['mid'] = {
        labels: ['Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'],
        datasets: [
            {
                label: 'Characters',
                data: [
                    props.classes.mid.Acolyte,
                    props.classes.mid.Knight,
                    props.classes.mid.Mage,
                    props.classes.mid.Rogue,
                    props.classes.mid.Scout,
                    props.classes.mid.Summoner,
                    props.classes.mid.Warrior,
                ],
                backgroundColor: [
                    colors.Acolyte.c1,
                    colors.Knight.c1,
                    colors.Mage.c1,
                    colors.Rogue.c1,
                    colors.Scout.c1,
                    colors.Summoner.c1,
                    colors.Warrior.c1,
                ],
            },
        ],
    };
    classesData['high'] = {
        labels: ['Acolyte', 'Knight', 'Mage', 'Rogue', 'Scout', 'Summoner', 'Warrior'],
        datasets: [
            {
                label: 'Characters',
                data: [
                    props.classes.high.Acolyte,
                    props.classes.high.Knight,
                    props.classes.high.Mage,
                    props.classes.high.Rogue,
                    props.classes.high.Scout,
                    props.classes.high.Summoner,
                    props.classes.high.Warrior,
                ],
                backgroundColor: [
                    colors.Acolyte.c1,
                    colors.Knight.c1,
                    colors.Mage.c1,
                    colors.Rogue.c1,
                    colors.Scout.c1,
                    colors.Summoner.c1,
                    colors.Warrior.c1,
                ],
            },
        ],
    };
}

const classesOptions = {
    responsive: true,
};
</script>

<style scoped></style>
