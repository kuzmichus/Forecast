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


interface TemperatureInterface
{
    public function getCurrent();
    public function getMax();
    public function getMin();
    public function __toString();
}
