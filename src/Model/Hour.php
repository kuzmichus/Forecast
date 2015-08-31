<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Model
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Hour implements  ForecastItemInterface
{
    protected $summary = null;
    protected $temperature = null;

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
        return $this->temperature;
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
        return (string)$this->getSummary();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->summary = $data['summary'];
        $this->temperature = (new Temperature())->setData($data['temperature']);
        return $this;
    }
}
