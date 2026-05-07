<?php

namespace App\Controllers;

use App\Utility\DataReader;
use Inertia\Inertia;
use Inertia\Response;
use Tempest\Router\Get;

class ContentController
{
    #[Get('/videos')]
    public function videos(): Response
    {
        $videos = DataReader::readData('videos');

        return Inertia::render('content/VideosPage', ['videos' => $videos]);
    }
}