<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */
declare(strict_types=1);
namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Wind implements ModelInterface
{
    /** @var float */
    protected $speed = null;

    /** @var float */
    protected $degree = null;

    /**
     * @api
     * @return float
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @api
     * @return float
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * @api
     * @retern string
     */
    public function getDirection()
    {
        $result = '';
        if ($this->degree >= 0 && $this->degree < 22.5) {
            $result = 'Север';
        } elseif ($this->degree >= 22.5 && $this->degree < 45) {
            $result = 'Север Северо-Восток';
        } elseif ($this->degree >= 45 && $this->degree < 67.5) {
            $result = 'Северо-Восток';
        } elseif ($this->degree >= 67.5 && $this->degree < 90) {
            $result = 'Восток Северо-восток';
        } elseif ($this->degree >= 90 && $this->degree < 112.5) {
            $result = 'Восток';
        } elseif ($this->degree >= 112.5 && $this->degree < 135) {
            $result = 'Восток Юго-Восток';
        } elseif ($this->degree >= 135 && $this->degree < 157.5) {
            $result = 'Юго-Восток';
        } elseif ($this->degree >= 157.5 && $this->degree < 180) {
            $result = 'Юг Юго-Восток';
        } elseif ($this->degree >= 180 && $this->degree < 202.5) {
            $result = 'Юг';
        } elseif ($this->degree >= 202.5 && $this->degree < 225) {
            $result = 'Юг Юго-Запад';
        } elseif ($this->degree >= 225 && $this->degree < 247.5) {
            $result = 'Юго-Запад';
        } elseif ($this->degree >= 247.5 && $this->degree < 270) {
            $result = 'Запал Юго-Запад';
        } elseif ($this->degree >= 270 && $this->degree < 292.5) {
            $result = 'Запад';
        } elseif ($this->degree >= 292.5 && $this->degree < 315) {
            $result = 'Запад Северо-Запад';
        } elseif ($this->degree >= 315 && $this->degree < 337.5) {
            $result = 'Северо-Запад';
        } else {
            $result = 'Север Северо-Запад';
        }
        return $result;
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

        $this->speed = $data['speed'];
        $this->degree = $data['degree'];

        return $this;
    }

    public function __toString()
    {
        return (string)$this->speed;
    }
}
