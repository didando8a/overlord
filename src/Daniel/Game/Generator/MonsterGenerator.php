<?php

namespace Daniel\Game\Generator;

use Daniel\Game\Model\CityCollection;
use Daniel\Game\Model\Monster;
use Daniel\Game\Model\MonsterCollection;

class MonsterGenerator
{
    protected $cityCollection;
    protected $numMonsters;

    public function __construct(CityCollection $cityCollection, $numMonsters)
    {
        if($numMonsters < 2 ){
            throw new \InvalidArgumentException('Invalid number of monsters (minimun 2)');
        }

        $this->cityCollection = $cityCollection;
        $this->numMonsters = $numMonsters;
    }

    public function generate()
    {
        $monsterCollection = new MonsterCollection();

        for ($i = 0; $i < $this->numMonsters; $i++){
            $monster = new Monster();
            $monster->setId($i);
            $monster->setCurrentCity($this->cityCollection->getRandomCity());
            $monsterCollection->addMonster($monster);
        }

        return $monsterCollection;
    }
} 