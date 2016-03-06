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


use Forecast\Models\HeatIndex;

class HeatIndexTest extends \PHPUnit_Framework_TestCase
{
    public function testSetter()
    {
        $heatIndex = new HeatIndex();

        $heatIndex->setTemp(10);
        self::assertEquals(10, $heatIndex->getTemp());

        $heatIndex->setDewPoint(0.5);
        self::assertEquals(0.5, $heatIndex->getDewPoint());
    }

    public function testCalc()
    {
        $heatIndex = new HeatIndex();

        $heatIndex->setTemp(30)
            ->setDewPoint(15);
        self::assertEquals(34, round($heatIndex->calc()));
    }

}
