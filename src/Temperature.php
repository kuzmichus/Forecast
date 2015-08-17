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


class Temperature implements TemperatureInterface
{
    protected $current = null;
    protected $max = null;
    protected $min = null;
    protected $apparent = null;


    public function getCurrent()
    {
        return $this->current;
    }

    public function getMax()
    {
        return $this->max;
    }

    public function getMin()
    {
        return $this->min;
    }

    public function __toString()
    {
        return strval($this->current);
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

        $this->current = $data['current'];
        $this->apparent =
            isset($data['apparent']) ? $data['apparent'] : $data['current'];
        $this->max = isset($data['max']) ? $data['max'] : $data['current'];
        $this->min = isset($data['min']) ? $data['min'] : $data['current'];

        return $this;
    }
}
