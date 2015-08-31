<?php
/**
 *
 */
namespace Forecast;
use Forecast\Model\Humidity;
use Forecast\Model\Precipitation;
use Forecast\Model\Temperature;
use Forecast\Model\Wind;

/**
 * Класс предатсавляет информацию о текущей погоде
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */
class Current implements ForecastItemInterface
{
    /** @var string  Информация солнце */
    protected $summary = null;

    /** @var Temperature  Информация о темперетуре */
    protected $temperature = null;

    /** @var Wind Информация о ветре */
    protected $wind = null;

    /** @var Humidity  Информация о влажности */
    protected $humidity = null;

    /** @var Precipitation вероятность осадков  */
    protected $precipitation = null;
    /**
     * Получение температуры
     *
     * @api
     *
     * @return Temperature
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * Ветер
     *
     * @api
     * @return Wind
     */
    public function getWind()
    {
        return $this->wind;
    }

    /**
     * Солнце
     *
     * @api
     * @return string
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Возвращает объект хронящий информацию о влажновсти
     *
     * @api
     * @return Humidity
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @return Precipitation
     */
    public function getPrecipitation()
    {
        return $this->precipitation;
    }

    /**
     * @param array $data Устанвыочные данные о погоде
     * @return $this
     */
    public function setData(array $data)
    {
        $this->summary = $data['summary'];
        $this->temperature = (new Temperature())->setData($data['temperature']);
        $this->wind = (new Wind())->setData($data['wind']);
        $this->precipitation = (new Precipitation())->setData($data['precipitation']);
        $this->humidity = (new Humidity())->setData($data['humidity']);

        return $this;
    }

    /**
     * Возвращает строку
     *
     * @api
     *
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getSummary();
    }
}
