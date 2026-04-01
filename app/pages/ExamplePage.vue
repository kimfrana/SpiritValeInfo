<template>
    <BaseLayout>
        <h2>Example Page</h2>

        <Button @click="count++">{{ count }}</Button>

        <button @click="count++">{{ count }} Counter</button>

        <MySelect
            placeholder="Search..."
            :options="options"
        ></MySelect>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '../Layouts/BaseLayout.vue';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import MySelect from '@/components/shared/MySelect.vue';

const count = ref(0);

const options = [
    { value: 1, label: 'A' },
    { value: 2, label: 'B' },
];
</script>

<style scoped></style>
