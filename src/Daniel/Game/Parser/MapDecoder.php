<?php

namespace Daniel\Game\Parser;

use Daniel\Game\Model\City;
use Daniel\Game\Model\CityCollection;
use Keboola\Csv\CsvFile as File;

class MapDecoder
{
    protected $file;

    public function __construct($file)
    {
        if (!file_exists($file)) {
            throw new \InvalidArgumentException('The specified file does not exists');
        }

        $this->file = $file;
    }

    public function decode()
    {
        $file = new CsvFile()
        $fileContent = new File($this->file);
        $cityCollection = new CityCollection();

        foreach ($fileContent as $row) {
            $neighbors = array();
            $rowData = explode(' ', $row[0]);
            $cityName = $rowData[0];
            for ($i = 1; $i < count($rowData); $i++) {
                $neighborData = explode('=', $rowData[$i]);
                $neighbors[$neighborData[0]] = $neighborData[1];
            }

            $city = new City();
            $city->setName($cityName);
            $city->setNeighbors($neighbors);

            $cityCollection->addCity($city);
        }

        return $cityCollection;
    }
}