<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Tests\Models
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Tests\Models;


use Forecast\Models\WindchillIndex;

class WindchillIndexTest extends \PHPUnit_Framework_TestCase
{
    public function testSetter()
    {
        $windchillIndex = new WindchillIndex();

        $windchillIndex->setTemp(10);
        self::assertEquals(10, $windchillIndex->getTemp());

        $windchillIndex->setWindSpeed(1);
        self::assertEquals(1, $windchillIndex->getWindSpeed());
    }

    public function testCalc()
    {
        $windchillIndex = new WindchillIndex();
        $windchillIndex->setTemp(-5)
            ->setWindSpeed(2.4);

        self::assertEquals(round(-8.84155569, 8), round($windchillIndex->calc(), 8));
        unset($windchillIndex);

        $windchillIndex = new WindchillIndex();
        $windchillIndex->setTemp(10)
            ->setWindSpeed(2.4);

        self::assertEquals(round(8.87895938, 8), round($windchillIndex->calc(), 8));
        unset($windchillIndex);
    }
}
