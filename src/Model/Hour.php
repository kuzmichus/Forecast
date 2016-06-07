<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Model
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */
declare(strict_types=1);
namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Hour implements  ForecastItemInterface
{
    /** @var \DateTime  */
    protected $date;
    protected $summary;

    /** @var Temperature  */
    protected $temperature;

    /** @var Wind */
    protected $wind;

    /** @var Humidity */
    protected $humidity;

    /** @var Precipitation */
    protected $precipitation;

    /** @var string */
    protected $icon;

    /**
     * @api
     *
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @api
     *
     * @return Temperature
     */
    public function getTemperature(): Temperature
    {
        return $this->temperature;
    }

    /**
     * @api
     *
     * @return Wind
     */
    public function getWind(): Wind
    {
        return $this->wind;
    }

    /**
     * @api
     *
     * @return string
     */
    public function __toString(): string 
    {
        return (string)$this->getSummary();
    }

    /**
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * @param array $data
     * @return ForecastItemInterface
     */
    public function setData(array $data): ForecastItemInterface
    {
        $this->date = $data['date'];
        $this->summary = $data['summary'];
        $this->temperature = (new Temperature())->setData($data['temperature']);
        $this->wind = (new Wind())->setData($data['wind']);
        $this->humidity = (new Humidity())->setData($data['humidity']);
        $this->precipitation = (new Precipitation())->setData($data['precipitation']);
        $this->icon = $data['icon'];
        return $this;
    }

    /**
     * @return Humidity
     */
    public function getHumidity(): Humidity
    {
        return $this->humidity;
    }

    /**
     * @return Precipitation
     */
    public function getPrecipitation(): Precipitation
    {
        return $this->precipitation;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
}
