<?php
/**
 *
 * PHP version 5.5
 *
 * @package Models
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Tests\Models;


use Forecast\Models\DewPoint;

class DewPointTest extends \PHPUnit_Framework_TestCase
{
    public function testSetter()
    {
        $dewPoint = new DewPoint();

        $dewPoint->setTemp(10);
        self::assertEquals(10, $dewPoint->getTemp());

        $dewPoint->setHumidity(0.5);
        self::assertEquals(0.5, $dewPoint->getHumidity());
    }

    public function testCalc()
    {
        $dewPoint = new DewPoint();
        $dewPoint->setTemp(20)
            ->setHumidity(70);

        self::assertEquals(14.3563109604, $dewPoint->calc());
    }
}
