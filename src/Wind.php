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


class Wind implements WindInterface
{
    protected $speed = null;
    protected $degree = null;

    public function getSpeed()
    {
        return $this->speed;
    }

    public function getDegree()
    {
        return $this->degree;
    }

    public function getDirection()
    {
        // TODO: Implement getDirection() method.
    }

    public function setData(array $data)
    {
        if (
            // check if the caller's class is one of the friend classes
            !($trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) ||
            !(isset($trace[1]['class']) && in_array(ForecastItemInterface::class, class_implements($trace[1]['class'])))
        ) {
            trigger_error('Member not available: setData', E_USER_ERROR);
        }

        $this->speed = $data['speed'];
        $this->degree = $data['degree'];

        return $this;
    }
}
