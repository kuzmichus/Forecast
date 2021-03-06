<?php
/**
 *
 * PHP version 5.5
 *
 * @package Forecast\Helper
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */
declare(strict_types=1);
namespace Forecast\Helper;


class Point
{
    const ADDRESS = 1;
    const POINT = 2;
    protected $latitude;
    protected $longitude;
    protected $address;

    protected $type = 0;

    /**
     * @api
     */
    public function __construct()
    {
        $numargs = func_num_args();
        if ($numargs > 2) {
            throw new \InvalidArgumentException('Ожидалось 1 или 2 параметра');
        } elseif ($numargs == 2) {
            $arg1 = func_get_arg(0);
            $arg2 = func_get_arg(1);
            if (is_double($arg1) && is_double($arg2)) {
                $this->latitude = $arg1;
                $this->longitude = $arg2;
                $this->type = self::POINT;
            } else {
                throw new \InvalidArgumentException();
            }
        } else {
            $arg1 = func_get_arg(0);
            if (is_string($arg1)) {
                $this->address = $arg1;
                $this->type = self::ADDRESS;
            }
        }
    }

    public function __toString(): string
    {
        return (string)$this->getLatitude() . ',' . $this->getLongitude();
    }

    /**
     * @api
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @api
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @api
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @api
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    public function getKey(): string
    {
        if ($this->type == self::ADDRESS) {
            return md5($this->address);
        } else {
            return md5($this->latitude . '-' . $this->longitude);
        }

    }

}
