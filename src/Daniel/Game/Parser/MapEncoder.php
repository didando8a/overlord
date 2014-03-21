<?php

namespace Daniel\Game\Parser;

use Daniel\Game\Model\City;
use Daniel\Game\Model\CityCollection;

class MapEncoder
{
    protected $cityCollection;

    public function __construct(CityCollection $cityCollection)
    {
        $this->cityCollection = $cityCollection;
    }

    public function encode()
    {
        $cities = $this->cityCollection->getCities();
        $result = array();

        /** @var City $city */
        foreach ($cities as $city) {
            if (!$city->isDestroyed()) {
                $row = $city->getName() . ' ';
                foreach ($city->getNeighbors() as $direction => $neighbor) {
                    $row .= $direction . '=' . $neighbor . ' ';
                }
                $row = trim($row);
                $result[] = $row;
            }
        }

        return $result;
    }
} 