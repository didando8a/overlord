<?php

namespace Daniel\Game\Model;

class City
{
    protected $name;
    protected $destroyed = false;
    protected $neighbors = array();

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setNeighbors(array $neighbors)
    {
        $this->neighbors = $neighbors;
    }

    public function getNeighbors()
    {
        return $this->neighbors;
    }

    public function getRandomNeighborCity()
    {
        $directions = array_keys($this->neighbors);

        if (!empty($directions)) {
            shuffle($directions);
            return $this->neighbors[$directions[0]];
        }

        return null;
    }

    public function removeNeighbor($direction)
    {
        unset($this->neighbors[$direction]);
    }

    public function isDestroyed()
    {
        return $this->destroyed;
    }

    public function setDestroyed($destroyed)
    {
        $this->destroyed = $destroyed;
    }

    public function hasNoWays()
    {
        return empty($this->neighbors);
    }
}