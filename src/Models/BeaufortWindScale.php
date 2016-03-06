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


/**
 * Class BeaufortWindScale
 *
 * Возвращает силу ветра в балах по шкале Бофорта в зависимости от скорости ветра
 * @see https://en.wikipedia.org/wiki/Beaufort_scale
 *
 * PHP version 5.5
 *
 * @package Forecast\Models
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */
class BeaufortWindScale
{
    const BWS_CALM            = 0;
    const BWS_LIGHT_AIR       = 1;
    const BWS_LIGHT_BREEZE    = 2;
    const BWS_GENTLE_BREEZE   = 3;
    const BWS_MODERATE_BREEZE = 4;
    const BWS_FRESH_BREEZE    = 5;
    const BWS_STRONG_BREEZE   = 6;
    const BWS_HIGH_WIND       = 7;
    const BWS_FRESH_GALE      = 8;
    const BWS_STRONG          = 9;
    const BWS_WHOLE_GALE      = 10;
    const BWS_VIOLENT_STORM   = 11;
    const BWS_HURRICANE_FORCE = 12;


    /** @var double $wind скорость ветра в м/с */
    private $wind = 0;

    /**
     * @return double
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * @param double $wind
     */
    public function setWind($wind)
    {
        if ($wind < 0) {
            throw new \InvalidArgumentException('Значение $windSpeed < 0');
        }
        $this->wind = $wind;
        return $this;
    }

    public function calc()
    {
        $wind = $this->getWind();

        if ($wind >= 0 && $wind < 0.3) {
            $number = self::BWS_CALM;
        } elseif ($wind <= 1.5) {
            $number = self::BWS_LIGHT_AIR;
        } elseif ($wind <= 3.3) {
            $number = self::BWS_LIGHT_BREEZE;
        } elseif ($wind <= 5.5) {
            $number = self::BWS_GENTLE_BREEZE;
        } elseif ($wind <= 8.0) {
            $number = self::BWS_MODERATE_BREEZE;
        } elseif ($wind <= 10.8) {
            $number = self::BWS_FRESH_BREEZE;
        } elseif ($wind <= 13.9) {
            $number = self::BWS_STRONG_BREEZE;
        } elseif ($wind <= 17.2) {
            $number = self::BWS_HIGH_WIND;
        } elseif ($wind <= 20.7) {
            $number = self::BWS_FRESH_GALE;
        } elseif ($wind <= 24.5) {
                $number = self::BWS_STRONG;
        } elseif ($wind <= 28.4) {
            $number = self::BWS_WHOLE_GALE;
        } elseif ($wind <= 32.6) {
            $number = self::BWS_VIOLENT_STORM;
        } else {
            $number = self::BWS_HURRICANE_FORCE;
        }

        return $number;
    }
}
