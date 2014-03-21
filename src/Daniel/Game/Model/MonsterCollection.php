<?php

namespace Daniel\Game\Model;

class MonsterCollection
{
    protected $monsters = array();

    public function addMonster(Monster $monster)
    {
        $this->monsters[] = $monster;
    }

    public function getMonsters()
    {
        return $this->monsters;
    }

    public function moveMonstersForCityCollection(CityCollection $cityCollection)
    {
        /** @var Monster $monster */
        foreach ($this->monsters as $monster) {
            $city = $monster->getCurrentCity();
            $cityName = $city->getName();
            $monster->setCurrentCity($cityCollection->getCityByName($cityName));

            $cityName = $city->getRandomNeighborCity();

            if (!is_null($cityName)) {
                $monster->setCurrentCity($cityCollection->getCityByName($cityName));
            } else {
                $monster->setIdle(true);
            }
        }
    }

    public function getMonstersInCity(City $city)
    {
        $monsterInCity = array();

        /** @var Monster $monster */
        foreach ($this->monsters as $monster) {
            if ($monster->getCurrentCity() === $city) {
                $monsterInCity[] = $monster;
            }
        }

        return $monsterInCity;
    }

    public function getConflicts()
    {
        $cities = array();
        $citiesWithConflict = array();
        $resultantConflicts = array();

        /** @var Monster $monster */
        foreach ($this->monsters as $monster) {
            if (!$monster->isIdle()) {
                $city = $monster->getCurrentCity();
                if (in_array($city, $cities)) {
                    if (!in_array($city, $citiesWithConflict)) {
                        $citiesWithConflict[] = $city;
                        $resultantConflict = array();
                        $resultantConflict['city'] = $city;
                        $resultantConflict['monsters'] = $this->getMonstersInCity($city);
                        $resultantConflicts[] = $resultantConflict;
                    }
                } else {
                    $cities[] = $city;
                }
            }
        }

        return $resultantConflicts;
    }
}