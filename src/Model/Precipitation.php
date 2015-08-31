<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Model
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Precipitation implements ModelInterface
{
    /** @var  int */
    protected $probability;

    /** @var  float */
    protected $intensity;

    /** @var  float */
    protected $accumulation;



    /** @var  string */
    protected $type;

    /**
     * @return mixed
     */
    public function getIntensity()
    {
        return $this->intensity;
    }

    /**
     * @return mixed
     */
    public function getProbability()
    {
        return $this->probability;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @api
     *
     * @return string
     */
    public function __toString()
    {
        return 'Вероятность дождя ' . $this->probability . '%';
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData(array $data)
    {
        if (
            !($trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) ||
            !(isset($trace[1]['class']) && in_array(ForecastItemInterface::class, class_implements($trace[1]['class'])))
        ) {
            trigger_error('Member not available: setData', E_USER_ERROR);
        }

        $this->intensity = $data['intensity'];
        $this->probability = $data['probability'];
        $this->type = $data['type'];

        return $this;
    }
}
