<template>
    <BaseLayout>
        <Head title="Server Status - SpiritVale Info"></Head>
        <h1 class="page-title">Server Status</h1>
        <div
            class="data-table"
            style="max-width: 600px; margin: 0"
        >
            <table>
                <thead>
                    <tr>
                        <th>Server</th>
                        <th>Region</th>
                        <th>Players</th>
                    </tr>
                </thead>
                <tbody>
                    <Deferred data="servers">
                        <template #fallback>
                            <tr>
                                <td
                                    colspan="3"
                                    class="left"
                                >
                                    Loading...
                                </td>
                            </tr>
                        </template>
                        <tr
                            v-for="server in servers"
                            :key="server.name"
                        >
                            <td class="left">{{ server.name }}</td>
                            <td class="left">{{ server.region }}</td>
                            <td class="left">{{ server.players }}</td>
                        </tr>
                        <tr>
                            <td
                                colspan="2"
                                class="left font-bold"
                            >
                                Sum
                            </td>
                            <td class="left">{{ sum }}</td>
                        </tr>
                    </Deferred>
                </tbody>
            </table>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Deferred, Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    servers?: Array<{ name: string; region: string; players: number }>;
}>();

const sum = computed(() => {
    let sum = 0;
    if (props.servers && props.servers.length) {
        props.servers.forEach((server) => {
            sum += server.players;
        });
    }

    return sum;
});
</script>

<style scoped></style>
