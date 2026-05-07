<?php

namespace App\Utility;

class DataConverter
{
    private static ?array $elements = null;
    private static ?array $statusEffects = null;
    private static ?array $skills = null;

    private static ?array $equipmentTypes = null;
    private static ?array $slots = null;

    public static function getElementName(int $id): string
    {
        if (self::$elements === null) {
            self::$elements = DataReader::readData('game/elements');
        }

        return self::$elements[$id] ?? '?';
    }

    public static function getSlotName(int $id): string
    {
        if (self::$slots === null) {
            self::$slots = DataReader::readData('game/slots');
        }

        return self::$slots[$id] ?? '?';
    }

    public static function getEquipmentTypeName(int $id): string
    {
        if (self::$equipmentTypes === null) {
            self::$equipmentTypes = DataReader::readData('game/equipmentTypes');
        }

        return self::$equipmentTypes[$id] ?? '?';
    }

    public static function getStatusEffectName(string $id): string
    {
        if (self::$statusEffects === null) {
            self::$statusEffects = DataReader::readData('game/statusEffects');
        }

        return self::$statusEffects[$id]['DisplayName'] ?? '?';
    }

    public static function getSkillName(?string $id): string
    {
        if (self::$skills === null) {
            self::$skills = DataReader::readData('game/skills');
        }

        return self::$skills[$id]['DisplayName'] ?? '?';
    }

    /** array{ Name: string, Type: int, Value: array{ Value: int, ValueLv: int, ValueStr: string } } */
    public static function statToString(array $stat): string
    {
        if (str_contains($stat['Name'], '_')) {
            $type = explode('_', $stat['Name'])[0];
        } else {
            $type = $stat['Name'];
        }

        return match($type) {
            'Str' => 'Str: ' . self::valueObjectString($stat),
            'Vit' => 'Vit: ' . self::valueObjectString($stat),
            'Agi' => 'Agi: ' . self::valueObjectString($stat),
            'Dex' => 'Dex: ' . self::valueObjectString($stat),
            'Int' => 'Int: ' . self::valueObjectString($stat),
            'Luk' => 'Luk: ' . self::valueObjectString($stat,),
            'AllStats' => 'All Stats: ' . self::valueObjectString($stat,),
            'SummonAllStats' => 'Summon All Stats: ' . self::valueObjectString($stat),
            'Hp' => 'Hp: ' . self::valueObjectString($stat),
            'Mp' => 'Mp: ' . self::valueObjectString($stat),
            'Atk' => 'Atk: ' . self::valueObjectString($stat),
            'Matk' => 'Matk: ' . self::valueObjectString($stat),
            'Def' => 'Def: ' . self::valueObjectString($stat),
            'Mdef' => 'Mdef: ' . self::valueObjectString($stat),
            'Hit' => 'Hit: ' . self::valueObjectString($stat),
            'Flee' => 'Flee: ' . self::valueObjectString($stat),
            'FleeMult' => 'Flee: ' . self::valueObjectString($stat, '%'),
            'Crit' => 'Crit: ' . self::valueObjectString($stat),
            'DefFlat' => 'Def Flat: ' . self::valueObjectString($stat),
            'MdefFlat' => 'Mdef Flat: ' . self::valueObjectString($stat),
            'ElementWeapon' => 'Enchant weapon with ' . self::getElementHtml(self::getElementName($stat['Value']['Value'])) . ' element',
            'ElementArmor' => 'Convert to ' . self::getElementHtml(self::getElementName($stat['Value']['Value'])) . ' element',
            'Leech' => 'Health on hit: ' . self::valueObjectString($stat),
            'LeechMp' => 'Mana on hit: ' . self::valueObjectString($stat),
            'LeechKill' => 'Health on kill (per 50 vit): ' . self::valueObjectString($stat),
            'LeechKillMp' => 'Mana on kill (per 50 int): ' . self::valueObjectString($stat),
            'Splash' => 'Splash: ' . self::valueObjectString($stat),
            'Range' => 'Range: ' . self::valueObjectString($stat),
            'StatusImmune' => 'Immune to ' . self::getStatusEffectName($stat['Value']['ValueStr']) . ': ' . self::valueObjectString($stat, '%'),
            'NoKnockback' => 'Immune to Knockback',
            'NoCastCancel' => 'Cast cannot be interrupted',
            'NoFlinch' => 'Immune to Flinching from damage',
            'NoReflect' => 'Immune to Reflect damage',
            'AutocastHit' => 'Chance to autocast ' . self::getSkillName($stat['Value']['ValueStr']) . ' when hit: ' . self::valueObjectString($stat, '%'),
            'AutocastAttack' => 'Chance to autocast ' . self::getSkillName($stat['Value']['ValueStr']) . ' when attacking: ' . self::valueObjectString($stat, '%'),
            'GrantSkill' => 'Grants Lv.' . $stat['Value']['Value'] . ' ' . self::getSkillName($stat['Value']['ValueStr']),
            'DamageToElement' => 'Damage vs ' . self::getElementHtml($stat['Value']['ValueStr']) . ' Enemies: ' . self::valueObjectString($stat, '%'),
            'DamageElement' => self::getElementHtml($stat['Value']['ValueStr']) . ' Damage: ' . self::valueObjectString($stat, '%'),
            'DamagePhysical' => 'Damage Physical: ' . self::valueObjectString($stat, '%'),
            'DamageMagic' => 'Damage Magic: ' . self::valueObjectString($stat, '%'),
            'SkillDamage' => self::getSkillName($stat['Value']['ValueStr']) . ' Damage ' . self::valueObjectString($stat, '%'),
            'SkillCooldown' => self::getSkillName($stat['Value']['ValueStr']) . ' Cooldown: ' . self::valueObjectString($stat, 's'),
            'CritDamage' => 'Crit Damage: ' . self::valueObjectString($stat, '%'),
            'ElementResist' => self::getElementHtml($stat['Value']['ValueStr']) . ' Resistance ' . self::valueObjectString($stat, '%'),
            'DamageFromMagic' => 'Damage From Magic: ' . self::valueObjectString($stat, '%'),
            'HpRegen' => 'Hp Regen: ' . self::valueObjectString($stat),
            'HpRegenMax' => 'Max hp recovered per second: ' . self::valueObjectString($stat, '%'),
            'MpRegen' => 'Mp Regen: ' . self::valueObjectString($stat),
            'MpRegenMax' => 'Max mp recovered per second: ' . self::valueObjectString($stat, '%'),
            'AtkSpd' => 'Atk Spd: ' . self::valueObjectString($stat, '%'),
            'SummonAtkSpd' => 'Summon Atk Spd: ' . self::valueObjectString($stat, '%'),
            'CastSpd' => 'Cast Spd: ' . self::valueObjectString($stat, '%'),
            'MoveSpd' => 'Move Spd: ' . self::valueObjectString($stat, '%'),
            'Healing' => 'Healing: ' . self::valueObjectString($stat, '%'),
            'SummonHealing' => 'Summon Healing: ' . self::valueObjectString($stat, '%'),
            'HealingReceived' => 'Healing Received: ' . self::valueObjectString($stat, '%'),
            'AtkMult' => 'Atk: ' . self::valueObjectString($stat, '%'),
            'SummonAtkMult' => 'Summon Atk: ' . self::valueObjectString($stat, '%'),
            'MatkMult' => 'Matk: ' . self::valueObjectString($stat, '%'),
            'SummonMatkMult' => 'Summon Matk: ' . self::valueObjectString($stat, '%'),
            'HpMult' => 'Hp: ' . self::valueObjectString($stat, '%'),
            'SummonHpMult' => 'Summon Hp: ' . self::valueObjectString($stat, '%'),
            'MpMult' => 'Mp: ' . self::valueObjectString($stat, '%'),
            'DefMult' => 'Def: ' . self::valueObjectString($stat, '%'),
            'MdefMult' => 'Mdef: ' . self::valueObjectString($stat, '%'),
            'HpRegenMult' => 'Hp Regen: ' . self::valueObjectString($stat, '%'),
            'MpRegenMult' => 'Mp Regen ' . self::valueObjectString($stat, '%'),
            'HitMult' => 'Total Hit: ' . self::valueObjectString($stat),
            'CritMult' => 'Total Critical Rate: ' . self::valueObjectString($stat, '%'),
            'DoubleAttack' => 'Double Attack: ' . self::valueObjectString($stat, '%'),
            'Block' => 'Block: ' . self::valueObjectString($stat, '%'),
            'ReflectDamage' => 'Reflect Damage: ' . self::valueObjectString($stat, '%'),
            'ExpRate' => 'Exp Rate: ' . self::valueObjectString($stat, '%'),
            'MpCost' => 'Mp Cost: ' . self::valueObjectString($stat, '%'),
            'ReflectSpell' => 'Chance to reflect single target magic: ' . self::valueObjectString($stat, '%'),
            'LeechChance' => 'Health leech chance: ' . self::valueObjectString($stat, '%'),
            'LeechAmount' => 'Health leech power: ' . self::valueObjectString($stat, '%'),
            'LeechMpChance' => 'Mana leech chance: ' . self::valueObjectString($stat, '%'),
            'LeechMpAmount' => 'Mana leech power: ' . self::valueObjectString($stat, '%'),
            'WeightLimit' => 'Weight Limit: ' . self::valueObjectString($stat),
            'SummonStatShare' => 'Attributes shared to summon: ' . self::valueObjectString($stat, '%'),
            'DamageMelee' => 'Damage Melee: ' . self::valueObjectString($stat, '%'),
            'DamageRanged' => 'Damage Ranged: ' . self::valueObjectString($stat, '%'),
            'DamageFromRanged' => 'Damage from Ranged: ' . self::valueObjectString($stat, '%'),
            'DamageFromMelee' => 'Damage from Melee: ' . self::valueObjectString($stat, '%'),
            'DamageFromElement' => 'Resist vs ' . self::getElementHtml($stat['Value']['ValueStr']) . ': ' . self::valueObjectString($stat, '%'),
            'SkillArea' => self::getSkillName($stat['Value']['ValueStr']) . ' Area: ' . self::valueObjectString($stat),
            'SkillDuration' => self::getSkillName($stat['Value']['ValueStr']) . ' Duration: ' . self::valueObjectString($stat, 's'),
            'SkillCost' => self::getSkillName($stat['Value']['ValueStr']) . ' Mana Cost: ' . self::valueObjectString($stat, '%'),
            'StatusDuration' => 'Status Duration: ' . self::valueObjectString($stat, '%'),
            'SkillRemoveKnockback' => self::getSkillName($stat['Value']['ValueStr']) . ': <span style="font-weight: bold; color: green;">Remove Knockback</span>',
            'SkillRemoveStatus' => self::getSkillName($stat['Value']['ValueStr']) . ':  <span style="font-weight: bold; color: green;">Remove Status</span>',
            'SkillPiercing' => 'Skill Piercing: ' . self::valueObjectString($stat, '%'),
            'SkillLevel' => self::getSkillName($stat['Value']['ValueStr']) . ' Level: ' . self::valueObjectString($stat),

            'PerfectCloak' => 'Perfect Cloak',
            'PerfectDodge' => 'Perfect Dodge',
            'Chain' => 'Chain: ' . self::valueObjectString($stat),
            'SkillCastTime' => self::getSkillName($stat['Value']['ValueStr']) . ' Cast Time: ' . self::valueObjectString($stat, 's'),
            'DamageStatus' => 'Status Damage: ' . self::valueObjectString($stat, '%'),
            'DropRate' => 'Drop Rate: ' . self::valueObjectString($stat, '%'),
            'AllResist' => 'All Resist: ' . self::valueObjectString($stat, '%'),
            'DamageCloseRange' => 'Deals increased damage at close range: ' . self::valueObjectString($stat, '%'),
            'SkillCharges' => 'Skill charges: ' . self::valueObjectString($stat),
            'MatkPerStr' => 'Matk per Str: ' . self::valueObjectString($stat),

            'SiphonMp' => 'Siphon Mp: ' . self::valueObjectString($stat),
            'SiphonHp' => 'Siphon Hp: ' . self::valueObjectString($stat),
            'AutocastChance' => 'Autocast Chance: ' . self::valueObjectString($stat, '%'),
            'SummonResist' => 'Summon Resist: ' . self::valueObjectString($stat, ''),
            'SkillHits' => 'Skill Hits: ' . self::valueObjectString($stat),
            'AtkSpdMult' => 'Attack Speed: ' . self::valueObjectString($stat, '%'),
            'CooldownRecovery' => 'Cooldown Recovery: ' . self::valueObjectString($stat, '%'),
            'StatusMaxStacks' => 'Status Stacks: ' . self::valueObjectString($stat),
            'AtkSpdLimit' => 'AtkSpdLimit: ' . self::valueObjectString($stat),
            'SkillSplash' => 'Skill Splash: ' . self::valueObjectString($stat),
            'DamageFarRange' => 'DamageFarRange: ' . self::valueObjectString($stat, '%'),
            'DefPierce' => 'DefPierce: ' . self::valueObjectString($stat),
            'AutocastSkill' => self::getSkillName($stat['Value']['ValueStr']) . ' autocasts ' . self::getSkillName($stat['Value']['ValueStr2']),
            default => $type,
        };
    }

    public static function valueObjectString(array $stat, string $suffix = ''): string {
        $statString = '';
        if ($stat['Value']['Value'] !== 0) {
            $statString .= '<span style="font-weight: bold; color: ' . self::getStatColor($stat['Name'], $stat['Value']['Value']) . '">' . self::valueToSignedString($stat['Value']['Value']) . $suffix . '</span>';

        }
        if ($stat['Value']['Value'] !== 0 && $stat['Value']['ValueLv'] !== 0) {
            $statString .= ' ';
        }
        if ($stat['Value']['ValueLv'] !== 0) {
            $statString .= '<span style="font-weight: bold; color: ' . self::getStatColor($stat['Name'], $stat['Value']['ValueLv']) . '">' . self::valueToSignedString($stat['Value']['ValueLv']) . $suffix . ' per refine</span>';
        }

        return $statString;
    }

    private static function getStatColor(string $type, int|float $value): string {
        $_type = explode('_', $type)[0];
        $negativeIsPositive = false;
        if ($_type === 'SkillCooldown' || $_type === 'DamageFromMagic' || $_type === 'MpCost' || $_type === 'SkillDuration' || $_type === 'SkillCastTime') {
            $negativeIsPositive = true;
        }

        $isPositiveStat = $value > 0;
        if ($negativeIsPositive) {
            $isPositiveStat = !$isPositiveStat;
        }
        return $isPositiveStat ? 'green' : 'red';
    }

    private static function valueToSignedString(int|float $value): string
    {
        if ($value < 0) {
            return '-' . abs($value);
        } else {
            return '+' . abs($value);
        }
    }

    private static function getElementHtml(?string $element): string {
        return '<span style="font-weight: bold; color: ' . self::getElementColor($element) . '">' . $element . '</span>';
    }

    private static function getElementColor(?string $element): string {
        return match ($element) {
            'Neutral' => '#86807d',
            'Fire' => '#ff7026',
            'Water' => '#24a8dc',
            'Earth' => '#bb7b2f',
            'Wind' => 'oklch(85.2% 0.199 91.936)',
            'Poison' => '#55bb2e',
            'Holy' => '#e89ea1',
            'Shadow' => '#755e94',
            'Undead' => '#C85AE0',
            default => 'black',
        };
    }
}