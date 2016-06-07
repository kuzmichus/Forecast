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
use Forecast\Model\Humidity;
use Forecast\Model\Precipitation;

class Hourly implements ForecastItemInterface
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
        return (string)$this->summary;
    }

    /**
     * @api
     *
     * @return Temperature
     */
    public function getTemperature(): Temperature
    {
        // TODO: Implement getTemperature() method.
    }

    /**
     * @api
     *
     * @return Wind
     */
    public function getWind(): Wind
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
        return $this->getSummary();
    }

    /**
     * @param array $data
     * @return ForecastItemInterface
     */
    public function setData(array $data): ForecastItemInterface
    {
        $this->summary = $data['summary'];

        foreach ($data['hours'] as $hour) {
            $this->hours[] = (new Hour())->setData($hour);
        }


        /*$this->temperature = (new Temperature())->setData($data['temperature']);
        $this->wind = (new Wind())->setData($data['wind']);
        $this->precipitation = (new Precipitation())->setData($data['precipitation']);
        $this->humidity = (new Humidity())->setData($data['humidity']);*/

        return $this;
    }

    public function onHours()
    {
        return $this->hours;
    }

    /**
     * @param int $hour
     *
     * @return Hour
     */
    public function inTime($seekingHour): Hour
    {
        $seekingHour = (int)$seekingHour;
        if ($seekingHour < 0 || $seekingHour > 23) {
            throw new \InvalidArgumentException();
        }

        /** @var Hour $hour */
        foreach ($this->hours as $hour) {

            $h = $hour->getDate()->format('H');
            if ((int)$hour->getDate()->format('H') === $seekingHour) {
                break;
            }
        }
        return $hour;
    }

    /**
     * @return Humidity
     */
    public function getHumidity()
    {
        // TODO: Implement getHumidity() method.
    }

    /**
     * @return Precipitation
     */
    public function getPrecipitation()
    {
        // TODO: Implement getPrecipitation() method.
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        // TODO: Implement getIcon() method.
    }
}
