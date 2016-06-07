<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Model
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */
declare(strict_types=1);

namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Humidity implements ModelInterface
{
    /** @var float  */
    protected $humidity = null;
    /** @var float  */
    protected $dewPoint = null;

    /**
     * @api
     *
     * @return float
     */
    public function getHumidity(): float
    {
        return $this->humidity;
    }

    /**
     * @api
     *
     * @return float
     */
    public function getDewPoint(): float
    {
        return $this->dewPoint;
    }

    /**
     * @api
     *
     * @return string
     */
    public function __toString(): string
    {
        return (string)$this->humidity;
    }

    public function setData(array $data): self
    {
        if (
            !($trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) ||
            !(isset($trace[1]['class']) && in_array(ForecastItemInterface::class, class_implements($trace[1]['class'])))
        ) {
            trigger_error('Member not available: setData', E_USER_ERROR);
        }

        $this->humidity = $data['humidity'] * 100;
        $this->dewPoint = isset($data['dewPoint']) ? $data['dewPoint'] : null;

        return $this;
    }
}
