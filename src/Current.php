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


class Current implements ForecastItemInterface
{

    /** @var Temperature  */
    protected $temperature = null;

    /** @var Wind  */
    protected $wind = null;
    /**
     * @return TemperatureInterface
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    public function setData(array $data)
    {
        $this->temperature = new Temperature();
        $this->temperature->setData($data['temperature']);

        $this->wind = (new Wind())->setData($data['wind']);
    }

    public function getWind()
    {
        return $this->wind;
    }
}
