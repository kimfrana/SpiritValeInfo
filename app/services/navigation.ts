export type NavigationItem = {
    name: string;
    href: string;
    activePrefixes?: string[];
    children?: NavigationItem[];
    external?: boolean;
    openInNewTab?: boolean;
};

export const primaryNavigation: NavigationItem[] = [
    { name: 'Home', href: '/', activePrefixes: ['/'] },
    { name: 'World Map', href: '/world-map' },
    { name: 'Maps', href: '/maps' },
    { name: 'Monsters', href: '/monsters' },
    { name: 'Cards', href: '/cards' },
    { name: 'Gems', href: '/gems' },
    { name: 'Equipment', href: '/equipment' },
    { name: 'Artifacts', href: '/artifacts' },
    {
        name: 'Wiki',
        href: 'https://spiritvale.info/wiki/Main_Page',
        external: true,
        openInNewTab: true,
        children: [
            {
                name: 'Recent Updates',
                href: 'https://spiritvale.info/wiki/Main_Page#Recent_Updates',
                external: true,
                openInNewTab: true,
            },
            {
                name: 'Classes',
                href: 'https://spiritvale.info/wiki/Classes',
                external: true,
                openInNewTab: true,
            },
            {
                name: 'Character',
                href: 'https://spiritvale.info/wiki/Character',
                external: true,
                openInNewTab: true,
            },
            {
                name: 'Items',
                href: 'https://spiritvale.info/wiki/Items',
                external: true,
                openInNewTab: true,
            },
            {
                name: 'Combat',
                href: 'https://spiritvale.info/wiki/Combat',
                external: true,
                openInNewTab: true,
            },
            {
                name: 'World',
                href: 'https://spiritvale.info/wiki/World',
                external: true,
                openInNewTab: true,
            },
        ],
    },
];

export const contentNavigation: NavigationItem[] = [
    { name: 'Build Simulator', href: '/build-simulator' },
    { name: 'Videos', href: '/videos' },
    { name: 'Guides', href: '/guides', activePrefixes: ['/guides', '/guide'] },
    { name: 'FAQ', href: '/faq' },
];

export const gameNavigation: NavigationItem[] = [
    { name: 'Server Status', href: '/game/server-status' },
    { name: 'Game Statistics', href: '/game/statistics' },
    { name: 'Leaderboards', href: '/game/leaderboards' },
    { name: 'Vending', href: '/game/vending' },
];