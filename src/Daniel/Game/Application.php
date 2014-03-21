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
    protected $numberMonsters;

    public function __construct($file, $numberMonsters)
    {
        $this->numberMonsters = $numberMonsters;

        $decoder = new MapDecoder($file);
        $this->cityCollection = $decoder->decode();

        $monsterGenerator = new MonsterGenerator($this->cityCollection, $numberMonsters);
        $this->monsterCollection = $monsterGenerator->generate();
    }

    public function play()
    {
        $numberOfCities = count($this->cityCollection->getCities());

        for ($i = 1; $i <= self::MAX_MOVEMENTS; $i++) {
#            if ($this->monsterCollection[$i]->currentCity->hasNoWays()) {
#                $this->monsterCollection[$i]->currentCity = $this->cityCollection->getRandomCity();
#            }
            $this->monsterCollection->moveMonstersForCityCollection($this->cityCollection);
            $conflicts = $this->monsterCollection->getConflicts();

            /** @var array $conflict
             */
            foreach ($conflicts as $conflict) {
                $this->cityCollection->removeCity($conflict['city']);

                $monsters = array();
                /** @var Monster $monster */
                foreach ($conflict['monsters'] as $monster) {
                    $monsters[] = $monster->getId();
                    $this->monsterCollection->removeMonster($monster);
                    $this->numberMonsters -= 1;
                }

                echo $conflict['city']->getName() . " has been destroyed by monsters " . implode(', ', $monsters) . "!\n";
                if ($this->numberMonsters === 0) {
                    echo "\n\nGame over. All monster have die!!!\n\n";
                    break;
                }
            }

            $numberOfCities -= count($conflicts);
            if ($numberOfCities === 0) {
                echo "\n\nGame over. All cities have been destroyed!!!\n\n";
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