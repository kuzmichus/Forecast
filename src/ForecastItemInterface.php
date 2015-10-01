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


use Forecast\Model\Humidity;
use Forecast\Model\Precipitation;
use Forecast\Model\Temperature;
use Forecast\Model\Wind;

interface ForecastItemInterface
{
    /**
     * @api
     *
     * @return string
     */
    public function getSummary();

    /**
     * @api
     *
     * @return Temperature
     */
    public function getTemperature();

    /**
     * @api
     *
     * @return Wind
     */
    public function getWind();

    /**
     * @return Humidity
     */
    public function getHumidity();

    /**
     * @return Precipitation
     */
    public function getPrecipitation();

    /**
     * @return string
     */
    public function getIcon();

    /**
     * @api
     *
     * @return string
     */
    public function __toString();

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data);
}
