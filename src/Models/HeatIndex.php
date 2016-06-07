<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Models
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */
declare(strict_types=1);
namespace Forecast\Models;


class HeatIndex
{
    /**
     * Температура в целсиях
     * @var float
     */
    protected $temp = null;

    /**
     * Коофецент влажность 0 < $humidity < 1
     * @var float
     */
    protected $dewPoint = null;

    /**
     * @return float
     */
    public function getTemp(): float
    {
        return $this->temp;
    }

    /**
     * @param float $temp
     */
    public function setTemp(float $temp): self
    {
        $this->temp = $temp;
        return $this;
    }

    /**
     * @return float
     */
    public function getDewPoint(): float
    {
        return $this->dewPoint;
    }

    /**
     * @param float $dewPoint
     */
    public function setDewPoint(float $dewPoint): self
    {
        $this->dewPoint = $dewPoint;
        return $this;
    }

    /**
     * 		<table border="1">
    <tr><td><strong>Humidex Range</strong></td><td><strong>Degree of Comfort</strong></td></tr>
    <tr><td>20-29</td><td style="color: #4CD900;">Comfortable</td></tr>
    <tr><td>30-39</td><td style="color: #FFD800;">Some Discomfort</td></tr>
    <tr><td>40-45</td><td style="color: #FF6A00;">Great Discomfort</td></tr>
    <tr><td>>45</td><td style="color: #FF0000;">Dangerous</td></tr>
    </table>
     *
     * @return float
     */
    public function calc(): float
    {
        $dewpointK = $this->getDewPoint() + 273.15;
        $e = 6.11 * exp(5417.7530 * ((1 / 273.16) - (1 / $dewpointK)));
        $h = (0.5555) * ($e - 10.0);
        $humidex = $this->getTemp() + $h;

        return $humidex;
    }

}
