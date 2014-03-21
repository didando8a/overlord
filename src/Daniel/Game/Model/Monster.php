<?php

namespace Daniel\Game\Model;

class Monster
{
    protected $id;
    protected $currentCity;
    protected $idle = false;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @param City $currentCity
     */
    public function setCurrentCity(City $currentCity)
    {
        $this->currentCity = $currentCity;
    }

    /**
     * @return City
     */
    public function getCurrentCity()
    {
        return $this->currentCity;
    }

    public function isIdle()
    {
        return $this->idle;
    }

    public function setIdle($idle)
    {
        $this->idle = $idle;
    }
} 