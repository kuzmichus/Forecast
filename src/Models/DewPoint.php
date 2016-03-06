<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Models
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Models;


class DewPoint
{
    /** @var float  */
    protected $temp = null;
    /** @var float  */
    protected $humidity = null;

    /**
     * @return float
     */
    public function getTemp()
    {
        return $this->temp;
    }

    /**
     * @param float $temp
     */
    public function setTemp($temp)
    {
        $this->temp = $temp;
        return $this;
    }

    /**
     * @return float
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @param float $humidity
     */
    public function setHumidity($humidity)
    {
        $this->humidity = $humidity;
        return $this;
    }

    /**
     * @return float
     */
    public function calc()
    {
        $a = 17.27;
        $b = 237.7;
        $t = $this->getTemp();

        $humidity = $this->getHumidity() / 100;

        $a1 = ($a * $t) / ($b + $t);
        $b1 = log($humidity);

        $dewPoint = ($b * ( $a1 + $b1)) / ( $a - ($a1 + $b1));

        return $dewPoint;
    }
}
