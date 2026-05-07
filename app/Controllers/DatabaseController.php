<?php

namespace App\Controllers;

use App\Models\Game\Card;
use App\Models\Game\Consumable;
use App\Models\Game\Equipment;
use App\Models\Game\Gem;
use App\Models\Game\Map;
use App\Models\Game\Material;
use App\Models\Game\Monster;
use App\Utility\DatabaseUtil;
use App\Utility\DataConverter;
use App\Utility\DataMapper;
use App\Utility\DataReader;
use App\Utility\GameDataUtil;
use App\Utility\UrlUtil;
use App\Utility\VendingUtil;
use Inertia\Inertia;
use Inertia\Response;
use Tempest\Http\ContentType;
use Tempest\Http\Responses\Json;
use Tempest\Http\Responses\NotFound;
use Tempest\Http\Responses\Ok;
use Tempest\Http\Responses\Redirect;
use Tempest\Router\Get;
use Tempest\View\View;
use function Tempest\view;

class DatabaseController
{
    #[Get('/maps')]
    public function maps(): Response {
        $maps = Map::getAll();
        $search = $_GET['search'] ?? '';

        $this->loadAdditionalDataMaps($maps);

        return inertia("database/MapsPage", [
            'search' => $search,
            'maps' => $maps,
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/maps/{slug}')]
    public function map(string $slug): Response | Redirect
    {
        $maps = Map::findBy('Slug', $slug);
        if (count($maps) === 0) {
            return new Redirect('/maps');
        }

        $this->loadAdditionalDataMaps($maps);

        return inertia("database/MapPage", [
            'maps' => $maps,
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    private function loadAdditionalDataMaps(array $maps) {
        Map::loadAdditionalData($maps);
        $monsters = [];
        foreach ($maps as $map) {
            foreach ($map->monsters as $monster) {
                $monsters[] = $monster;
            }
        }
        Monster::loadAdditionalData($monsters);
    }

    #[Get('/monsters')]
    public function monsters(): Response {
        $element = $_GET['element'] ?? 'All';
        $type = $_GET['type'] ?? 'All';
        $search = $_GET['search'] ?? '';

        $monsters  = Monster::getAll();
        Monster::loadAdditionalData($monsters);

        return inertia("database/MonstersPage", [
            'element' => $element,
            'type' => $type,
            'search' => $search,
            'monsters' => $monsters,
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/monsters/{slug}')]
    public function monster(string $slug): Response | Redirect
    {
        $monster = Monster::getBySlug($slug);

        if ($monster === null) {
            return new Redirect('/monsters');
        }
        Monster::loadAdditionalData([$monster]);

        $GLOBALS['title'] = $monster->DisplayName;
        $GLOBALS['description'] = 'A level ' . $monster->Level . ' ' . $monster->Element . ' monster.';

        $locations = [];
        $maps = Map::getAll();
        Map::loadAdditionalData($maps);

        foreach ($maps as $map) {
            foreach ($map->MonsterPool as $monsterGameId) {
                if ($monsterGameId === $monster->GameId) {
                    $locations[] = [
                        'name' => $map->DisplayName,
                        'slug' => $map->Slug,
                    ];
                }
            }
        }

        $spawner = null;
        if ($monster->IsBoss) {
            $spawner = Consumable::getByMonsterGameId($monster->GameId);
        }

        return inertia("database/MonsterPage", [
            'monster' => json_decode(json_encode($monster, JSON_PARTIAL_OUTPUT_ON_ERROR), true),
            'spawner' => $spawner,
            'locations' => $locations,
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/cards')]
    public function cards(): Response
    {
        $slot = $_GET['slot'] ?? 'All';
        $type = $_GET['type'] ?? 'All';
        $search = $_GET['search'] ?? '';

        return inertia("database/CardsPage", [
            'slot' => $slot,
            'type' => $type,
            'search' => $search,
            'cards' => Card::getAll(),
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/cards/{slug}')]
    public function card(string $slug): Response | Redirect
    {
        $card = Card::getBySlug($slug);
        if ($card === null) {
            return new Redirect('/cards');
        }

        $GLOBALS['title'] = $card->DisplayName;
        $GLOBALS['description'] = $card->Description;
        $GLOBALS['icon'] = $card->icon;

        return inertia("database/CardPage", [
            'card' => $card,
            'droppedBy' => DatabaseUtil::getDroppedBy('Card', $card->GameId),
            'gameData' => DatabaseUtil::getGameData(),
            'vending' => Inertia::defer(fn () => VendingUtil::getVendingData(4, $card->GameId, null)),
            'vendingHistory' => Inertia::defer(fn () => VendingUtil::getVendingHistoryData(4, $card->GameId)),
        ]);
    }





    #[Get('/gems')]
    public function gems(): Response
    {
        $type = $_GET['type'] ?? 'All';
        $search = $_GET['search'] ?? '';

        return inertia("database/GemsPage", [
            'type' => $type,
            'search' => $search,
            'gems' => Gem::getAll(),
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/gems/{slug}')]
    public function gem(string $slug): Response | Redirect
    {
        $gem = Gem::getBySlug($slug);
        if ($gem === null) {
            return new Redirect('/gems');
        }

        $GLOBALS['title'] = $gem->DisplayName;
        $GLOBALS['description'] = $gem->Description;
        if (count($gem->statsTexts)) {
            $GLOBALS['description'] .= " | " . strip_tags(join(' | ', $gem->statsTexts));
        }
        $GLOBALS['icon'] = $gem->icon;

        return inertia("database/GemPage", [
            'gem' => $gem,
            'droppedBy' => DatabaseUtil::getDroppedBy('GemDrops', $gem->GameId),
            'gameData' => DatabaseUtil::getGameData(),
            'vending' => Inertia::defer(fn () => VendingUtil::getVendingData(5, $gem->GameId, null)),
            'vendingHistory' => Inertia::defer(fn () => VendingUtil::getVendingHistoryData(5, $gem->GameId)),
        ]);
    }

    #[Get('/artifacts')]
    public function artifacts(): Response
    {
        $monsters = DataReader::readData('game/monsters');
        $artifacts = DataReader::readData('game/artifacts');

        $search = $_GET['search'] ?? '';

        $dropMap = [];
        foreach ($monsters as $monster) {
            if (isset($monster['Artifact']['Id']) && isset($monster['Artifact']['DropChance'])) {
                if (!isset($dropMap[$monster['Artifact']['Id']])) {
                    $dropMap[$monster['Artifact']['Id']] = [];
                }
                $dropMap[$monster['Artifact']['Id']][] = [
                    'monster' => [
                        'name' => $monster['DisplayName'],
                        'isBoss' => $monster['IsBoss'],
                        'level' => $monster['Level'],
                        'slug' => $monster['Slug'],
                    ],
                    'chance' => $monster['Artifact']['DropChance'],
                ];
            }
        }

        $frontEndData = array_values(array_map(function (array $artifact) use ($dropMap) {
            $statsFullSet = [];
            foreach ($artifact['FullSet'] as $stat) {
                $statsFullSet[] = DataConverter::statToString($stat);
            }

            $statsPerPiece = [];
            foreach ($artifact['PerPiece'] as $stat) {
                $statsPerPiece[] = DataConverter::statToString($stat);
            }

            $statsPerRefine = [];
            foreach ($artifact['PerRefine'] as $stat) {
                $statsPerRefine[] = DataConverter::statToString($stat);
            }

            $maps = [];
            foreach ($artifact['Maps'] as $gameId) {
                $foundMap = Map::findOneBy('GameId', $gameId);
                if ($foundMap !== null) {
                    $maps[] = [
                        'slug' => $foundMap->Slug,
                        'name' => $foundMap->DisplayName,
                        'minLevel' => $foundMap->MonsterMinLevel,
                        'maxLevel' => $foundMap->MonsterMaxLevel,
                    ];
                }
            }

            $name = $artifact['DisplayName'];

            $drops = $dropMap[$artifact['GameId']] ?? [];
            usort($drops, function ($a, $b) { return $a['chance'] === $b['chance'] ? strcmp($a['monster']['name'], $b['monster']['name']) : ($a['chance'] < $b['chance'] ? 1 : -1); });

            return [
                'name' => $name,
                'statsFullSet' => $statsFullSet,
                'statsPerPiece' => $statsPerPiece,
                'statsPerRefine' => $statsPerRefine,
                'maps' => $maps,
                'drops' => $drops,
            ];
        }, $artifacts));

        return inertia("database/ArtifactsPage", [
            'search' => $search,
            'artifacts' => json_decode(json_encode($frontEndData, JSON_PARTIAL_OUTPUT_ON_ERROR), true),
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/equipment')]
    public function equipmentList(): Response
    {
        $type = $_GET['type'] ?? 'All';
        $search = $_GET['search'] ?? '';

        $equipmentTypes = DataReader::readData('game/equipmentTypes');
        sort($equipmentTypes);

        $equipmentList = Equipment::getAll();
        Equipment::loadAdditionalData($equipmentList);

        return inertia("database/EquipmentListPage", [
            'type' => $type,
            'typeOptions' => array_values($equipmentTypes),
            'search' => $search,
            'equipmentList' => $equipmentList,
            'gameData' => DatabaseUtil::getGameData(),
        ]);
    }

    #[Get('/equipment/{slug}')]
    public function equipment(string $slug): Response | Redirect
    {
        $equipment = Equipment::getBySlug($slug);

        if ($equipment === null) {
            return new Redirect('/equipment');
        }

        Equipment::loadAdditionalData([$equipment]);

        $GLOBALS['title'] = $equipment->DisplayName;
        $GLOBALS['description'] = $equipment->Description;
        $GLOBALS['icon'] = 'item-' . $equipment->icon;

        return inertia("database/EquipmentPage", ['equipment' => $equipment]);
    }

    #[Get('/consumables/{slug}')]
    public function consumable(string $slug): Response | Redirect
    {
        $consumable = Consumable::getBySlug($slug);

        if ($consumable === null) {
            return new Redirect('/');
        }

        Consumable::loadAdditionalData([$consumable]);

        $boss = null;
        if ($consumable->Type === 1 && isset($consumable->Value['ValueStr'])) {
            $boss = Monster::findOneBy('GameId', $consumable->Value['ValueStr']);
        }

        $GLOBALS['title'] = $consumable->DisplayName;
        $GLOBALS['description'] = $consumable->Description;
        $GLOBALS['icon'] = 'item-' . $consumable->icon;

        return inertia("database/ConsumablePage", [
            'consumable' => $consumable,
            'boss' => $boss,
            'vending' => Inertia::defer(fn () => VendingUtil::getVendingData(1, $consumable->GameId, null)),
            'vendingHistory' => Inertia::defer(fn () => VendingUtil::getVendingHistoryData(1, $consumable->GameId)),
        ]);
    }

    #[Get('/materials/{slug}')]
    public function material(string $slug): Response | Redirect
    {
        $material = Material::getBySlug($slug);

        if ($material === null) {
            return new Redirect('/');
        }

        Material::loadAdditionalData([$material]);

        $GLOBALS['title'] = $material->DisplayName;
        $GLOBALS['description'] = $material->Description;
        $GLOBALS['icon'] = 'item-' . $material->icon;

        return inertia("database/MaterialPage", [
            'material' => $material,
            'vending' => Inertia::defer(fn () => VendingUtil::getVendingData(0, $material->GameId, null)),
            'vendingHistory' => Inertia::defer(fn () => VendingUtil::getVendingHistoryData(0, $material->GameId)),
        ]);
    }
}