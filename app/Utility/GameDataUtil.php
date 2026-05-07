<?php

namespace App\Utility;

class GameDataUtil
{
    private static array $missingDependencies = [];
    private static array $missingDependenciesSlug = [];

    public static function addDependency(string $className, string $id): void
    {
        if (!isset(self::$missingDependencies[$className])) {
            self::$missingDependencies[$className] = [];
        }
        self::$missingDependencies[$className][] = $id;
    }

    public static function addDependencyBySlug(string $className, string $slug): void
    {
        if (!isset(self::$missingDependenciesSlug[$className])) {
            self::$missingDependenciesSlug[$className] = [];
        }
        self::$missingDependenciesSlug[$className][] = $slug;
    }

    public static function loadAllDependencies(): void
    {
        foreach (self::$missingDependencies as $className => $idList) {
            $className::getByIds(array_unique($idList));
        }
        foreach (self::$missingDependenciesSlug as $className => $idList) {
            $className::getBySlugs(array_unique($idList));
        }
    }
}