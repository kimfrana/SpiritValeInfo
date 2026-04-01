import '../app/main.entrypoint.css'
import 'tippy.js/dist/tippy.css';
import 'tippy.js/themes/light-border.css';
import 'tippy.js/themes/translucent.css';
import 'tippy.js/animations/shift-away-subtle.css';

import { createInertiaApp, router } from '@inertiajs/vue3'
import { createApp, DefineComponent, h, nextTick } from 'vue';
import { plugin as VueTippy } from 'vue-tippy';
import { createPinia } from 'pinia';
import { useTooltipStore } from '@/stores/tooltip';

const pinia = createPinia();

let tooltipStore: any = null;
let currentPageProps: Record<string, any> | null = null;

const tippyOptions = {
    directive: 'tippy',
    defaultProps: {
        placement: 'right',
        arrow: false,
        theme: 'spiritvale',
        allowHTML: true,
        animation: 'shift-away-subtle',
        delay: [100, 0],
        inertia: true,
        followCursor: true,
        maxWidth: 550,
        interactive: false, //TODO: check
        onTrigger: async (instance: any, event: any) => {
            if (instance.props.contentLazy) {
                if (tooltipStore === null) {
                    tooltipStore = useTooltipStore();
                }
                if (tooltipStore) {
                    const gameDataByType = currentPageProps?.gameData?.[instance.props.contentLazy.type];

                    if (instance.props.contentLazy.slug) {
                        const gameData = gameDataByType?.find((m: any) => m.Slug === instance.props.contentLazy.slug);
                        if (gameData === undefined || gameData === null) {
                            console.error('gameData not found: ' + instance.props.contentLazy.type + ' ' + instance.props.contentLazy.slug);
                        } else {
                            tooltipStore.type = instance.props.contentLazy.type;
                            tooltipStore.data = gameData;
                        }
                    } else {
                        console.error('legacy');
                        tooltipStore.type = instance.props.contentLazy.type;
                        tooltipStore.data = instance.props.contentLazy.data;
                    }

                    await nextTick();

                    const container = document.getElementById('tooltip-container-lazy');
                    if (container) {
                        instance.setContent(container.innerHTML);
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        },
    },
};

void createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue');
        // Lowercase only the first directory segment for nested pages.
        // Keep top-level filenames intact, e.g. 'HomePage' should stay 'HomePage'.
        const segments = name.split('/');
        const normalizedName = segments.length > 1
            ? [segments[0].toLowerCase(), ...segments.slice(1)].join('/')
            : name;

        return pages[`./pages/${normalizedName}.vue`]();
    },
    setup({ el, App, props, plugin }) {
        currentPageProps = props.initialPage.props as Record<string, any>;
        router.on('navigate', (event) => {
            currentPageProps = event.detail.page.props as Record<string, any>;
        });

        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(VueTippy, tippyOptions)
            .mount(el)
    },
})
