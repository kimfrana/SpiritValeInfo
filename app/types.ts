export type GameElement = 'Neutral' | 'Fire' | 'Water' | 'Earth' | 'Wind' | 'Poison' | 'Holy' | 'Shadow' | 'Undead';

export type Card = { Slug: string; GameId: string; DisplayName: string; Affix: string; Description: string; IsBoss: number; icon: string; slot: string; stats: string[] };
export type Gem = { Slug: string; GameId: string; DisplayName: string; Description: string; Affix: string; IsBoss: number; Stats: Array<object>; icon: string; statsTexts: string[] };

export type ItemType = 'equipment' | 'material' | 'consumable' | 'card' | 'gem';
export type GameDataType = ItemType | 'skill' | 'monster';

export type Drop = {
    id: string;
    slug: string;
    type: ItemType;
    name: string;
    chance: number;
    icon: string;
};

export type Monster = {
    Slug: string;
    GameId: string;
    DisplayName: string;
    Race: number;
    Size: number;
    Level: number;
    IsBoss: number;
    IsHostile: number;
    Element: GameElement;
    Skills: any;
    EquipDrops: any;
    MaterialDrops: any;
    ConsumableDrops: any;
    GemDrops: any;
    Card: any|null;

    elementName: GameElement;
    skillList: Skill[];
    drops: Array<Drop>;
}

export type GameMap = {
    Slug: string;
    GameId: string;
    DisplayName: string;
    MonsterMinLevel: number;
    MonsterMaxLevel: number;
    MonsterPool: string[];
    BossMonster: string|null;
    monsters: Array<Monster>;
}

export type Equipment = {
    Slug: string;
    GameId: string;
    DisplayName: string;
    Description: string;
    Type: number;
    PrimaryStats: object[];
    SecondaryStats: object[];
    Slots: number;
    Set: string|null;
    Element: number;
    icon: string;
    typeName: string;
    statsPrimary: Array<string>;
    statsSecondary: Array<string>;
    drops: Array<{ monster: { name: string; isBoss: boolean; level: number; slug: string; }; chance: number }>;
    crafting: null|object;
}

export type Consumable = {
    Slug: string;
    GameId: string;
    DisplayName: string;
    Description: string;
    Reusable: number;
    Type: number;
    icon: string;
    drops: Array<{ monster: { name: string; isBoss: boolean; level: number; slug: string; }; chance: number }>;
}

export type Material = {
    Slug: string;
    GameId: string;
    icon: string;
    DisplayName: string;
    Description: string;
    drops: Array<{ monster: { name: string; isBoss: boolean; level: number; slug: string; }; chance: number }>;
}

export type Skill = {
    Slug: string;
    GameId: string;
    DisplayName: string;
    Description: string;
    CastType: number|null;
    MaxLv: number;
    isPassive: boolean;
    requirements: Array<{ name: string; level: number }>;
    values: any;
}