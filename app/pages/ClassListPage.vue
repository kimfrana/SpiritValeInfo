<template>
    <Head title="Classes - SpiritVale Info"></Head>
    <BaseLayout>
        <h1 class="page-title">Classes</h1>
        <div class="data-table">
            <table class="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Class</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="c in classes"
                        :key="c.name"
                    >
                        <td style="width: 100px">
                            <img
                                style="width: 64px"
                                :src="'https://spiritvale.info/content/game/icons/' + c.icon + '.webp'"
                                :alt="c.name"
                                v-if="c.icon"
                            />
                        </td>
                        <td>
                            <a
                                target="_blank"
                                :href="'/classes/' + c.name"
                                >{{ c.name }}</a
                            >
                        </td>
                        <td>{{ c.description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps<{
    classes: Array<{ name: string; icon: string | null; description: string }>;
}>();
</script>

<style scoped></style>
