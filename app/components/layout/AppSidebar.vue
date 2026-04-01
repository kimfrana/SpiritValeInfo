<template>
    <aside
        id="logo-sidebar"
        class="fixed left-0 top-0 z-40 h-screen w-64 -translate-x-full border-r border-gray-700 bg-gray-800 pt-20 transition-transform sm:translate-x-0"
        aria-label="Sidebar"
    >
        <div class="h-full bg-gray-800 px-3 pb-4">
            <ul class="space-y-1 font-medium">
                <li
                    v-for="item in primaryNavigation"
                    :key="item.href"
                >
                    <template v-if="item.children?.length">
                        <button
                            type="button"
                            class="flex w-full items-center rounded-lg px-2 py-1.5 text-white transition-colors hover:bg-gray-700"
                            :class="isExpanded(item) ? 'bg-gray-700' : ''"
                            @click="toggleExpanded(item)"
                        >
                            <span class="ms-3 flex-1 text-left">{{ item.name }}</span>
                            <svg
                                class="h-4 w-4 transition-transform"
                                :class="isExpanded(item) ? 'rotate-90' : ''"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>

                        <ul
                            v-if="isExpanded(item)"
                            class="mt-2 space-y-1 border-l border-gray-700 pl-2"
                        >
                            <li
                                v-for="child in item.children"
                                :key="child.href"
                            >
                                <a
                                    :href="child.href"
                                    class="flex items-center rounded-lg px-2 py-1 text-sm transition-colors"
                                    :class="isActive(child)
                                        ? 'bg-gray-700 text-white'
                                        : 'text-gray-200 hover:bg-gray-700 hover:text-white'"
                                    :target="child.openInNewTab ? '_blank' : undefined"
                                    :rel="child.openInNewTab ? 'noreferrer' : undefined"
                                >
                                    <span class="ms-3">{{ child.name }}</span>
                                </a>
                            </li>
                        </ul>
                    </template>

                    <a
                        v-else-if="item.external"
                        :href="item.href"
                        class="flex items-center rounded-lg px-2 py-1.5 transition-colors"
                        :class="isActive(item)
                            ? 'bg-gray-700 text-white'
                            : 'text-white hover:bg-gray-700 group'"
                        :target="item.openInNewTab ? '_blank' : undefined"
                        :rel="item.openInNewTab ? 'noreferrer' : undefined"
                    >
                        <span class="ms-3 flex-1">{{ item.name }}</span>
                        <img
                            v-if="getIconForItem(item.name)"
                            :src="getIconForItem(item.name)"
                            :alt="item.name"
                            class="h-5 w-5 shrink-0"
                        >
                    </a>

                    <Link
                        v-else
                        :href="item.href"
                        class="flex items-center rounded-lg px-2 py-1.5 transition-colors"
                        :class="isActive(item)
                            ? 'bg-gray-700 text-white'
                            : 'text-white hover:bg-gray-700 group'"
                    >
                        <span class="ms-3 flex-1">{{ item.name }}</span>
                        <img
                            v-if="getIconForItem(item.name)"
                            :src="getIconForItem(item.name)"
                            :alt="item.name"
                            class="h-5 w-5 shrink-0"
                        >
                    </Link>
                </li>

                <li class="mt-2 border-t border-gray-700 pt-2">
                    <ul class="space-y-1">
                        <li
                            v-for="item in contentNavigation"
                            :key="item.href"
                        >
                            <Link
                                :href="item.href"
                                class="flex items-center rounded-lg px-2 py-1.5 transition-colors"
                                :class="isActive(item)
                                    ? 'bg-gray-700 text-white'
                                    : 'text-white hover:bg-gray-700 group'"
                            >
                                <span class="ms-3">{{ item.name }}</span>
                            </Link>
                        </li>
                    </ul>
                </li>

                <li class="mt-2 border-t border-gray-700 pt-2">
                    <ul class="space-y-1">
                        <li
                            v-for="item in gameNavigation"
                            :key="item.href"
                        >
                            <Link
                                :href="item.href"
                                class="flex items-center rounded-lg px-2 py-1.5 transition-colors"
                                :class="isActive(item)
                                    ? 'bg-gray-700 text-white'
                                    : 'text-white hover:bg-gray-700 group'"
                            >
                                <span class="ms-3">{{ item.name }}</span>
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import { contentNavigation, gameNavigation, primaryNavigation, type NavigationItem } from '@/services/navigation';

const page = usePage();
const expanded = ref<Record<string, boolean>>({});

const currentPath = computed(() => {
    const path = page.url.split('?')[0] ?? '/';
    return path === '' ? '/' : path;
});

function isActive(item: NavigationItem) {
    if (item.external) {
        return false;
    }

    const prefixes = item.activePrefixes ?? [item.href];

    return prefixes.some((prefix) => {
        if (prefix === '/') {
            return currentPath.value === '/';
        }

        return currentPath.value === prefix || currentPath.value.startsWith(prefix + '/');
    });
}

function isExpanded(item: NavigationItem) {
    return expanded.value[item.href] ?? false;
}

function toggleExpanded(item: NavigationItem) {
    expanded.value[item.href] = !isExpanded(item);
}

const sideMenuIconByName: Record<string, string> = {
    Cards: '/navbar/PictoIcon_Card.Png',
    Gems: '/navbar/Icon_Gem_03.png',
    Equipment: '/navbar/PictoIcon_Attack.Png',
    Artifacts: '/navbar/PictoIcon_Snowflake.Png',
};

function getIconForItem(name: string) {
    return sideMenuIconByName[name];
}
</script>