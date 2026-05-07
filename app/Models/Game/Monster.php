<?php

namespace App\Models\Game;

use App\Utility\DataConverter;
use App\Utility\DataMapper;
use App\Utility\DataReader;
use App\Utility\GameDataUtil;
use App\Utility\UrlUtil;

class Monster extends AbstractGameModel
{
    public string $DisplayName;
    public int $Level;
    public int $IsBoss;
    public int $IsHostile;
    public string $Element;
    public array $Skills;
    public array $EquipDrops;
    public array $MaterialDrops;
    public array $ConsumableDrops;
    public ?array $Artifact;
    public array $ArtifactSlots;
    public ?array $Card;
    public array $GemDrops;

    //additional
    public array $skillList = [];
    public array $drops = [];

    public function __construct(array $data)
    {
        $data['ArtifactSlots'] = [];
        parent::__construct($data);
    }

    public static function loadAdditionalData(array $list): void
    {
        $items = DataReader::readData('game/items');
        $skills = DataReader::readDataByClassName(Skill::class);;

        foreach ($list as $monster) {
            $drops = [];
            foreach ($monster->EquipDrops as $drop) {
                if (!isset($items[$drop['Id']])) {
                    error_log('Missing Item: ' . $drop['Id']);
                    continue;
                }

                $item = $items[$drop['Id']];
                $drops[] = [
                    'id' => $drop['Id'],
                    'slug' => $item['Slug'],
                    'icon' => 'item-' . $item['Slug'],
                    'type' => 'equipment',
                    'name' => $item['DisplayName'],
                    'chance' => $drop['DropChance'],
                ];
                GameDataUtil::addDependency(Equipment::class, $drop['Id']);
            }
            foreach ($monster->MaterialDrops as $drop) {
                if (!isset($items[$drop['Id']])) {
                    error_log('Missing Item: ' . $drop['Id']);
                    continue;
                }

                $item = $items[$drop['Id']];
                $drops[] = [
                    'id' => $drop['Id'],
                    'slug' => $item['Slug'],
                    'icon' => 'item-' . $item['Slug'],
                    'type' => 'material',
                    'name' => $item['DisplayName'],
                    'chance' => $drop['DropChance'],
                ];
                GameDataUtil::addDependency(Material::class, $drop['Id']);
            }
            foreach ($monster->ConsumableDrops as $drop) {
                if (!isset($items[$drop['Id']])) {
                    error_log('Missing Item: ' . $drop['Id']);
                    continue;
                }

                $item = $items[$drop['Id']];
                $drops[] = [
                    'id' => $drop['Id'],
                    'slug' => $item['Slug'],
                    'icon' => 'item-' . $item['Slug'],
                    'type' => 'consumable',
                    'name' => $item['DisplayName'],
                    'chance' => $drop['DropChance'],
                ];
                GameDataUtil::addDependency(Consumable::class, $drop['Id']);
            }
            if (isset($monster->Card['Id'])) {
                if (!isset($items[$monster->Card['Id']])) {
                    error_log('Missing Item: ' . $monster->Card['Id']);
                } else {
                    $item = $items[$monster->Card['Id']];
                    $drops[] = [
                        'id' => $monster->Card['Id'],
                        'slug' => $item['Slug'],
                        'icon' => $monster->IsBoss ? 'item-card-golden' : 'item-card-normal',
                        'type' => 'card',
                        'name' => $item['DisplayName'],
                        'chance' => $monster->Card['DropChance'],
                    ];
                    GameDataUtil::addDependency(Card::class, $monster->Card['Id']);
                }
            }
            foreach ($monster->GemDrops as $drop) {
                if (!isset($items[$drop['Id']])) {
                    error_log('Missing Item: ' . $drop['Id']);
                    continue;
                }

                $drops[] = [
                    'id' => $drop['Id'],
                    'slug' => $monster->Slug,
                    'icon' => $monster->IsBoss ? 'gem-boss' : 'gem-skill',
                    'type' => 'gem',
                    'name' => $items[$drop['Id']]['DisplayName'],
                    'chance' => $drop['DropChance'],
                ];
                GameDataUtil::addDependency(Gem::class, $drop['Id']);
            }

            $monsterSkills = [];
            foreach ($monster->Skills as $skillEntry) {
                $skillId = $skillEntry['Id'];
                if (isset($skills[$skillId])) {
                    $skill = $skills[$skillId];
                    $monsterSkills[] = $skill['DisplayName'];
                }
            }

            $monster->skillList = $monsterSkills;
            $monster->drops = $drops;
        }
    }
}