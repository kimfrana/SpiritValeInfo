<?php

namespace App\Controllers;

use App\Models\Game\Card;
use App\Models\Game\Equipment;
use App\Models\Game\GameClass;
use App\Models\Game\Skill;
use App\Utility\DataConverter;
use App\Utility\DataMapper;
use App\Utility\DataReader;
use Inertia\Response;
use Tempest\Http\Responses\Redirect;
use Tempest\Router\Get;
use function Tempest\map;

class GameStatisticsController
{
    #[Get('/game/statistics')]
    public function page(): Response
    {
        return inertia('GameStatisticsPage', [
            'levels' => DataReader::readData('stats/levels'),
            'classes' => DataReader::readData('stats/classes'),
        ]);
    }

    #[Get('/game/leaderboards')]
    public function leaderboards(): Response
    {
        $levelLeaderboards = [
            'All' => $this->fetchLeaderboard('All'),
            'Acolyte' => $this->fetchLeaderboard('Acolyte'),
            'Knight' => $this->fetchLeaderboard('Knight'),
            'Mage' => $this->fetchLeaderboard('Mage'),
            'Rogue' => $this->fetchLeaderboard('Rogue'),
            'Scout' => $this->fetchLeaderboard('Scout'),
            'Summoner' => $this->fetchLeaderboard('Summoner'),
            'Warrior' => $this->fetchLeaderboard('Warrior'),
        ];

        return inertia('game/LeaderboardsPage', [
            'levelLeaderboards' => $levelLeaderboards,
        ]);
    }

    #[Get('/game/characters/{slug}')]
    public function character(string $slug): Response|Redirect
    {
        $characterIndex = json_decode(file_get_contents(__DIR__ . '/../../data/stats/character-index.json'), true);
        if (!isset($characterIndex[$slug])) {
            return new Redirect('/game/leaderboards');
        }

        $accountId = $characterIndex[$slug]['accountId'];
        $characterUid = $characterIndex[$slug]['characterUid'];
        $url = env('CHARACTER_API') . '?accountId=' . $accountId . '&characterUid=' . $characterUid;
        $character = $this->readUrlCached(__DIR__ . '/../../data/characters/' . $slug . '.json', $url, 3600);
        if ($character === false || !isset($character['game'])) {
            return new Redirect('/game/leaderboards');
        }

        $character = $character['game'];

        $skillsTemp = Skill::getAll();
        $skillLevels = [];
        foreach ($skillsTemp as $skill) {
            $skillLevels[$skill->Slug] = 0;
        }

        $cardIds = [];
        $equipIds = [];
        $skillIds = [];
        foreach ($character['Equips'] as $equip) {
            $equipIds[] = $equip['Equip']['Id'];
            foreach ($equip['Equip']['Cards'] as $cardId) {
                $cardIds[] = $cardId;
            }
        }

        foreach ($character['Skills']['Skills'] as $skill) {
            $skillIds[] = $skill['Id'];
        }

        $cards = Card::getByIds($cardIds);
        $cardMap = [];
        foreach ($cards as $card) {
            $cardMap[$card->GameId] = $card;
        }

        $equipmentList = Equipment::getByIds($equipIds);
        $equipMap = [];
        foreach ($equipmentList as $equip) {
            $equipMap[$equip->GameId] = $equip;
        }

        $skills = Skill::getByIds($skillIds);
        $skillMap = [];
        foreach ($skills as $skill) {
            $skillMap[$skill->GameId] = $skill;
        }

        $statMap = DataReader::readData('game/statMap');

        $classMap = [
            0 => 'Warrior',
            1 => 'Mage',
            2 => 'Rogue',
            3 => 'Knight',
            4 => 'Summoner',
            5 => 'Acolyte',
            6 => 'Scout',
            16 => 'Wizard',
            21 => 'Shinobi',
        ];

        $equipList = [];
        foreach ($character['Equips'] as $equip) {
            $equipAffixes = [];

            $equipCards = [];
            foreach ($equip['Equip']['Cards'] as $cardId) {
                if (isset($cardMap[$cardId])) {
                    $equipCards[] = $cardMap[$cardId];
                    $equipAffixes[] = $cardMap[$cardId]->Affix;
                }
            }

            if (!isset($equipMap[$equip['Equip']['Id']])) {
                error_log('Missing Item: ' . $equip['Equip']['Id']);
            }

            $equipList[] = [
                'affixes' => array_unique($equipAffixes),
                'item' => $equipMap[$equip['Equip']['Id']] ?? null,
                'refineLevel' => $equip['Equip']['Refine'],
                'randomStats' => null,
                'cards' => $equipCards,
            ];
        }

        $characterSkills = [];
        foreach ($character['Skills']['Skills'] as $skill) {
            $characterSkills[] = [
                'skill' => $skillMap[$skill['Id']],
                'level' => $skill['Level'],
            ];
        }

        $baseClass = $classMap[$character['Archetypes'][0]] ?? null;
        $advancedClass = $classMap[$character['Archetypes'][1]] ?? null;

        $GLOBALS['title'] = $character['Name'];
        $GLOBALS['description'] = 'Level ' . $character['Level'] . ' / ' . $character['JobLevel'] . ' ' . ($advancedClass ?? $baseClass);

        $skillInfo = $this->buildSkillTrees($baseClass, $advancedClass);

        foreach ($characterSkills as $characterSkill) {
            $skillLevels[$characterSkill['skill']->id] = $characterSkill['level'];
        }

        return inertia('game/CharacterPage', [
            'character' => [
                'name' => $character['Name'],
                'level' => $character['Level'],
                'jobLevel' => $character['JobLevel'],
                'class' => $baseClass,
                'advancedClass' => $advancedClass,
                'attributes' => [
                    'STR' => $character['Attributes'][0],
                    'VIT' => $character['Attributes'][1],
                    'AGI' => $character['Attributes'][2],
                    'DEX' => $character['Attributes'][3],
                    'INT' => $character['Attributes'][4],
                    'LUK' => $character['Attributes'][5],
                ],
                'equipList' => $equipList,
                'skills' => $characterSkills,
            ],
            'cards' => $cards,
            'equipList' => $equipmentList,
            'skills' => array_values($skills),
            'skillTree' => $skillInfo['skillTreeBase'],
            'skillTreeAdvanced' => $skillInfo['skillTreeAdvanced'],
            'skillMap' => $skillInfo['skillMap'],
            'skillLevels' => $skillLevels,
        ]);
    }

    private function fetchLeaderboard(string $type): array
    {
        $list = DataReader::readData('stats/leaderboards_' . $type);

        return array_map(
            fn($data) => [
                'name' => $data['Name'],
                'class' => $data['Class'],
                'advancedClass' => $data['AdvancedClass'],
                'level' => $data['Level'],
                'jobLevel' => $data['JobLevel'],
                'maxLevelDate' => $data['maxLevelDate'],
                'slug' => $data['slug'],
            ],
            $list,
        );
    }

    private function buildSkillTrees(?string $baseClass, ?string $advancedClass): array
    {
        $classes = DataReader::readData('game/classes');
        $skillList = DataReader::readData('game/skills');

        $publicSkillTree = [];
        $skills = [];
        $skillMap = [];

        if ($baseClass === null && $advancedClass === null) {
            return [
                'skillTreeBase' => [[], [], [], [], [], []],
                'skillTreeAdvanced' => [[], [], [], [], [], []],
                'skillMap' => [],
            ];
        }

        foreach ($classes as $class) {
            $skillIdListTemp = [];
            $publicSkillTree[$class['DisplayName']] = [[], [], [], [], [], []];
            foreach ($class['CustomSkillTree'] as $skillRow) {
                foreach ($skillRow as $skillGameId) {
                    if ($skillGameId !== '') {
                        $skillIdListTemp[] = $skillGameId;
                    }
                }
            }

            foreach ($skillIdListTemp as $id) {
                if (isset($skillList[$id])) {
                    $skill = $skillList[$id];

                    $requirements = [];
                    foreach ($skill['Requirements'] as $requirement) {
                        if (isset($skillList[$requirement['Id']])) {
                            $reqSkill = $skillList[$requirement['Id']];
                            $requirements[] = [
                                'id' => strtolower(str_replace(' ', '-', $reqSkill['DisplayName'])),
                                'name' => $reqSkill['DisplayName'],
                                'level' => $requirement['Level'],
                            ];
                        }
                    }

                    $skills[$id] = [
                        'id' => strtolower(str_replace(' ', '-', $skill['DisplayName'])),
                        'name' => $skill['DisplayName'],
                        'description' => $skill['Description'],
                        'maxLevel' => $skill['MaxLv'],
                        'isPassive' => $skill['CastType'] === null,
                        'requirements' => $requirements,
                        'values' => DataMapper::skillValues($skill),
                    ];

                    $skillMap[strtolower(str_replace(' ', '-', $skill['DisplayName']))] = [
                        'id' => strtolower(str_replace(' ', '-', $skill['DisplayName'])),
                        'name' => $skill['DisplayName'],
                        'description' => $skill['Description'],
                        'maxLevel' => $skill['MaxLv'],
                        'isPassive' => $skill['CastType'] === null,
                        'requirements' => $requirements,
                        'values' => DataMapper::skillValues($skill),
                    ];
                }
            }

            for ($row = 0; $row < 6; $row++) {
                for ($col = 0; $col < 7; $col++) {
                    $skillId = $class['CustomSkillTree'][$row][$col] ?? '';
                    $skill = $skills[$skillId] ?? null;

                    $publicSkillTree[$class['DisplayName']][$row][$col] = $skill === null ? null : $skill;
                }
            }
        }

        $frontEndData = [
            'classes' => GameClass::getAll(),
            'classSkillTrees' => $publicSkillTree,
            'skills' => array_values($skills),
            'skillMap' => $skillMap,
        ];

        return [
            'skillTreeBase' => $publicSkillTree[$baseClass],
            'skillTreeAdvanced' => $advancedClass === null ? null : $publicSkillTree[$advancedClass],
            'skillMap' => $skillMap,
        ];
    }

    private function readUrlCached(string $filePath, string $url, int $time): array|false
    {
        if (!file_exists($filePath) || filemtime($filePath) < time() - $time) {
            file_put_contents($filePath, file_get_contents($url));
        }

        return json_decode(file_get_contents($filePath), true);
    }
}
