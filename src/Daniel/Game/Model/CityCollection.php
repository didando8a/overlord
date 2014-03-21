<?php

namespace Daniel\Game\Model;

class CityCollection
{
    protected $cities = array();

    public function addCity(City $city)
    {
        $this->cities[] = $city;
    }

    public function getCities()
    {
        return $this->cities;
    }

    public function getRandomCity()
    {
        $position = rand(0, count($this->cities) - 1);
        return $this->cities[$position];
    }

    public function getCityByName($cityName)
    {
        /** @var City $city */
        foreach ($this->cities as $city) {
            if ($city->getName() === $cityName) {
                return $city;
            }
        }

        throw new \LogicException('City name not found');
    }

    public function removeCity(City $cityToRemove)
    {
        /** @var City $city */
        foreach ($this->cities as $key => $city) {
            if ($city === $cityToRemove) {
                /** @var City $tempCity */
                $tempCity = $this->cities[$key];
                $tempCity->setDestroyed(true);
            } else {
                $neighbors = $city->getNeighbors();
                foreach ($neighbors as $direction => $neighbor) {
                    if ($cityToRemove->getName() === $neighbor) {
                        /** @var City $tempCity */
                        $tempCity = $this->cities[$key];
                        $tempCity->removeNeighbor($direction);
                    }
                }
            }
        }
    }
}