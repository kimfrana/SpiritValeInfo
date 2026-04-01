<template>
    <Head title="Frequently Asked Questions (FAQ)"></Head>
    <BaseLayout>
        <h1 class="page-title">Frequently Asked Questions (FAQ)</h1>
        <div
            class="flow-root p-8 px-12"
            v-for="category in categories"
        >
            <div class="py-3 uppercase text-lg text-gray-400 font-medium">
                {{ category.title }}
            </div>
            <div class="-my-4 flex flex-col divide-y divide-gray-700">
                <details
                    class="group py-4 [&_summary::-webkit-details-marker]:hidden"
                    v-for="(item, index) in category.list"
                    :key="index"
                >
                    <summary class="flex items-center justify-between gap-1.5 text-white">
                        <h2 class="text-lg font-medium">{{ item.question }}</h2>

                        <svg
                            class="size-5 shrink-0 transition-transform duration-300 group-open:-rotate-180"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19 9l-7 7-7-7"
                            />
                        </svg>
                    </summary>

                    <p
                        class="pt-4 text-white"
                        v-html="item.answer"
                    ></p>
                </details>
            </div>
        </div>
    </BaseLayout>
</template>

<script setup lang="ts">
import BaseLayout from '@/layouts/BaseLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps<{
    categories: Array<{ title: string; list: Array<{ question: string; answer: string }> }>;
}>();
</script>

<style scoped></style>
