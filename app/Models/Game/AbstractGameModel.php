<?php

namespace App\Models\Game;

use App\Utility\DataReader;

abstract class AbstractGameModel
{
    public string $Slug;
    public string $GameId;

    private static array $cache = [];

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    protected static function readGameData(): array
    {
        return DataReader::readDataByClassName(static::class);
    }

    /** @return static[] */
    public static function getAll(bool $hydrate = true): array
    {
        return static::mapDataMultiple(static::readGameData(), $hydrate);
    }

    /** @return static[] */
    public static function getByIds(array $ids): array
    {
        $list = self::readGameData();
        $filteredList = array_filter($list, fn (array $element) => in_array($element['GameId'], $ids));
        return static::mapDataMultiple($filteredList);
    }

    public static function getBySlug(string $slug): ?static
    {
        return static::findOneBy('Slug', $slug);
    }

    /** @return static[] */
    public static function getBySlugs(array $slugs): array
    {
        $list = self::readGameData();
        $filteredList = array_filter($list, fn (array $element) => in_array($element['Slug'], $slugs));
        return static::mapDataMultiple($filteredList);
    }

    public static function findOneBy(string $key, string $value): ?static
    {
        $list = self::readGameData();
        $data = array_find($list, fn (array $element) => $element[$key] === $value);

        if ($data === null) {
            return null;
        }

        return static::mapDataMultiple([$data])[0];
    }

    public static function findBy(string $key, string $value): array
    {
        $list = self::readGameData();
        $filteredList = array_filter($list, fn (array $element) => $element[$key] === $value);

        return static::mapDataMultiple($filteredList);
    }

    public static function getCached(string $className): array
    {
        $elements = [];

        foreach (self::$cache as $key => $element) {
            if (str_starts_with($key, $className . '_')) {
                $elements[] = $element;
            }
        }

        return $elements;
    }

    //abstract protected static function mapDataSingle(array $data): ?static;

    /** @return static[] */
    protected static function mapDataMultiple(array $list): array
    {
        return self::createObjectList(static::class, $list);
    }

    protected static function createObject(string $className, array $data): static
    {
        $identifierKey = 'GameId';
        $identifier = $data[$identifierKey];
        $cacheIndex = $className . '_' . $identifier;
        if (!isset(self::$cache[$cacheIndex])) {
            self::$cache[$cacheIndex] = new $className($data);
        }
        return self::$cache[$cacheIndex];
    }

    /**
     * @return static[]
     */
    protected static function createObjectList(string $className, array $dataList): array
    {
        $objectList = [];
        foreach ($dataList as $data) {
            $objectList[] = self::createObject($className, $data);
        }
        return $objectList;
    }

    public static function loadAdditionalData(array $list): void
    {
        //
    }
}