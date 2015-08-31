<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast;


use Forecast\Model\Hour;

class Hourly implements  ForecastItemInterface
{
    /** @var float */
    protected $summary = null;

    /** @var array */
    protected $hours = [];
    /**
     * @api
     *
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @api
     *
     * @return Temperature
     */
    public function getTemperature()
    {
        // TODO: Implement getTemperature() method.
    }

    /**
     * @api
     *
     * @return Wind
     */
    public function getWind()
    {
        // TODO: Implement getWind() method.
    }

    /**
     * @api
     *
     * @return string
     */
    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->summary = $data['summary'];

        foreach($data['hours'] as $hour) {
            $this->hours[] = (new Hour())->setData($hour);
        }



        /*$this->temperature = (new Temperature())->setData($data['temperature']);
        $this->wind = (new Wind())->setData($data['wind']);
        $this->precipitation = (new Precipitation())->setData($data['precipitation']);
        $this->humidity = (new Humidity())->setData($data['humidity']);*/

        return $this;
    }
}
