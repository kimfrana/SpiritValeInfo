<?php

namespace App\Controllers;

use App\Models\Game\Card;
use App\Models\Game\Map;
use App\Utility\DataReader;
use App\Utility\VendingUtil;
use Inertia\Inertia;
use Inertia\Response;
use Tempest\Http\Responses\Json;
use Tempest\Router\Get;
use function Tempest\map;

class VendingController {

    #[Get('/game/vending')]
    public function page(): Response
    {
        $filterTypes = ['materials' => 0, 'consumables' => 1, 'equipment' => 2, 'artifacts' => 3, 'cards' => 4, 'gems' => 5];

        $filterType = $filterTypes[$_GET['filterType'] ?? ''] ?? null;
        $filterName = $_GET['filterName'] ?? null;

        return inertia('gAame/VendingPage', [
            'vending' => Inertia::defer(fn () => VendingUtil::getVendingData($filterType, null, $filterName)),
            'filterType' => $_GET['filterType'] ?? 'all',
            'filterName' => $_GET['filterName'] ?? '',
        ]);
    }
}