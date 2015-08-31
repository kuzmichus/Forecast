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
