<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast\Model;


use Forecast\ForecastItemInterface;

class Temperature implements ModelInterface
{
    /**
     * @var float
     */
    protected $current = null;

    /**
     * @var float
     */
    protected $max = null;

    /**
     * @var float
     */
    protected $min = null;

    /**
     * @var float
     */
    protected $apparent = null;

    /**
     * @api
     *
     * @return float
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * @api
     *
     * @return float
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @api
     *
     * @return float
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @api
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->current;
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

        $this->current = $data['current'];
        $this->apparent =
            isset($data['apparent']) ? $data['apparent'] : $data['current'];
        $this->max = isset($data['max']) ? $data['max'] : $data['current'];
        $this->min = isset($data['min']) ? $data['min'] : $data['current'];

        return $this;
    }
}
