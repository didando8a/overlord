<?php

namespace Daniel\Game;

use Daniel\Game\Generator\MonsterGenerator;
use Daniel\Game\Model\Monster;
use Daniel\Game\Parser\MapDecoder;
use Daniel\Game\Parser\MapEncoder;

class Application
{
    const MAX_MOVEMENTS = 10000;

    protected $cityCollection;
    protected $monsterCollection;

    public function __construct($file, $numberMonsters)
    {
        $decoder = new MapDecoder($file);
        $this->cityCollection = $decoder->decode();

        $monsterGenerator = new MonsterGenerator($this->cityCollection, $numberMonsters);
        $this->monsterCollection = $monsterGenerator->generate();
    }

    public function play()
    {
        $numberOfCities = count($this->cityCollection->getCities());
        for ($i = 1; $i <= self::MAX_MOVEMENTS; $i++) {
            $this->monsterCollection->moveMonstersForCityCollection($this->cityCollection);
            $conflicts = $this->monsterCollection->getConflicts();

            foreach ($conflicts as $conflict) {
                $this->cityCollection->removeCity($conflict['city']);

                $monsters = array();
                /** @var Monster $monster */
                foreach ($conflict['monsters'] as $monster) {
                    $monsters[] = $monster->getId();
                    $this->monsterCollection->removeMonster($monster);
                }

                echo $conflict['city']->getName() . " has been destroyed by monsters " . implode(', ', $monsters) . "!\n";
            }

            $numberOfCities -= count($conflicts);
            if ($numberOfCities === 0) {
                echo "Game over. All cities have been destroyed!!!\n";
                return;
            }
        }

        $encoder = new MapEncoder($this->cityCollection);

        echo "-------------------------------------------\n";
        foreach ($encoder->encode() as $line) {
            echo $line . "\n";
        }
    }
}