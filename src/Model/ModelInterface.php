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


interface ModelInterface
{
    public function __toString();
    public function setData(array $data);
}
