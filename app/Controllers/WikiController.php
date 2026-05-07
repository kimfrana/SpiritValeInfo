<?php

namespace App\Controllers;

use App\Models\Game\Card;
use App\Models\Game\Consumable;
use App\Models\Game\Equipment;
use App\Models\Game\Gem;
use App\Models\Game\Map;
use App\Models\Game\Material;
use App\Models\Game\Monster;
use App\Models\Game\Skill;
use App\Utility\DatabaseUtil;
use App\Utility\GameDataUtil;
use Tempest\Http\Response;
use Tempest\Http\Responses\NotFound;
use Tempest\Http\Responses\Redirect;
use Tempest\Router\Get;

class WikiController
{
    #[Get('/wiki/{slug}')]
    public function generalWikiPage(string $slug): Response
    {
        $redirects = [
            'gold' => 'Coin',
            'npc' => 'Non-Player_Character',
        ];

        $slugLower = strtolower($slug);
        if (isset($redirects[$slugLower])) {
            return new Redirect('/wiki/' . $redirects[$slugLower]);
        }

        $fileName = $slug . 'Page';
        $filePath = __DIR__ . "/../pages/wiki/$fileName.vue";
        if (!file_exists($filePath)) {
            error_log("WikiController::generalWikiPage(): File not found: $filePath");
            return new NotFound();
        }

        $gameDataLinkInfoList = $this->extractGameDataLinks($filePath);
        $this->addDependenciesByGameDataLinks($gameDataLinkInfoList);
        error_log(json_encode($gameDataLinkInfoList));
        
        return inertia("wiki/$fileName", ['gameData' => DatabaseUtil::getGameData()]);
    }

    function extractGameDataLinks(string $filePath): array
    {
        $content = file_get_contents($filePath);

        $pattern = '/<GameDataLink\b[^>]*\btype="([^"]+)"[^>]*\bslug="([^"]+)"[^>]*\/?>/i';

        preg_match_all($pattern, $content, $matches, PREG_SET_ORDER);

        $results = [];

        foreach ($matches as $match) {
            $results[] = [
                'type' => $match[1],
                'slug' => $match[2],
            ];
        }

        return $results;
    }

    /**
     * @param array<array{type: string, slug: string}> $gameDataLinkInfoList
     * @return void
     */
    private function addDependenciesByGameDataLinks(array $gameDataLinkInfoList): void
    {
        foreach ($gameDataLinkInfoList as $gameDataLinkInfo) {
            $className = match ($gameDataLinkInfo['type']) {
                'card' => Card::class,
                'consumable' => Consumable::class,
                'equipment' => Equipment::class,
                'gem' => Gem::class,
                'map' => Map::class,
                'material' => Material::class,
                'monster' => Monster::class,
                'skill' => Skill::class,
            };
            GameDataUtil::addDependencyBySlug($className, $gameDataLinkInfo['slug']);
        }
    }
}