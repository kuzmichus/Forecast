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


use Forecast\Models\BeaufortWindScale;

class BeaufortWindScaleTest extends \PHPUnit_Framework_TestCase
{
    public function testSetter()
    {
        $scale = new BeaufortWindScale();
        $scale->setWind(10);
        self::assertEquals(10, $scale->getWind());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetInvalid()
    {
        $scale = new BeaufortWindScale();
        $scale->setWind(-1);
    }

    public function testCalc()
    {
        $scale = new BeaufortWindScale();
        $scale->setWind(0.2);
        self::assertEquals(BeaufortWindScale::BWS_CALM, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(0.3);
        self::assertEquals(BeaufortWindScale::BWS_LIGHT_AIR, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(1.51);
        self::assertEquals(BeaufortWindScale::BWS_LIGHT_BREEZE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(3.31);
        self::assertEquals(BeaufortWindScale::BWS_GENTLE_BREEZE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(5.51);
        self::assertEquals(BeaufortWindScale::BWS_MODERATE_BREEZE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(8.01);
        self::assertEquals(BeaufortWindScale::BWS_FRESH_BREEZE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(10.81);
        self::assertEquals(BeaufortWindScale::BWS_STRONG_BREEZE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(13.91);
        self::assertEquals(BeaufortWindScale::BWS_HIGH_WIND, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(17.21);
        self::assertEquals(BeaufortWindScale::BWS_FRESH_GALE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(20.71);
        self::assertEquals(BeaufortWindScale::BWS_STRONG, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(24.51);
        self::assertEquals(BeaufortWindScale::BWS_WHOLE_GALE, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(28.41);
        self::assertEquals(BeaufortWindScale::BWS_VIOLENT_STORM, $scale->calc());
        unset($scale);

        $scale = new BeaufortWindScale();
        $scale->setWind(32.61);
        self::assertEquals(BeaufortWindScale::BWS_HURRICANE_FORCE, $scale->calc());
        unset($scale);

    }
}
