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


use Forecast\Helper\Point;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\NullCacheItemPool;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class ForecastAbstract
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */
abstract class ForecastAbstract
{
    /**
     * @internal
     * @var NullCacheItemPool
     */
    protected $cache = null;

    /**
     * @internal
     * @var LoggerInterface
     */
    protected $logger = null;

    /**
     * @internal
     * @var string
     */
    protected $lang = 'en';

    /**
     * @internal
     * @var string
     */
    protected $units = 'si';

    /**
     *
     *
     * @param CacheItemPoolInterface|null $cache Экземпляра класса кэширования по стандарту PSR-6
     * @param LoggerInterface|null $logger Экземляр класса логера сандарта PSR-3
     *
     * @api
     */
    public function __construct(CacheItemPoolInterface $cache = null, LoggerInterface $logger = null)
    {

        $this->cache = $cache ?: new NullCacheItemPool();
        $this->logger = $logger ?: new NullLogger();
    }

    /**
     * Возвращает код языка
     *
     * @api
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @api
     * @param string $lang
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Возвращает объект с описанием текущей погоды
     *
     * @param Point $point Класс с коорденатами места для которой запрашивается погода
     *
     * @api
     * @return \Forecast\Current|null Объект с текущей погодой
     */
    public function getCurrent(Point $point)
    {
        $item = $this->cache->getItem($this->getCacheKeyCurrent($point));
        if (!$item->exists()) {
            $item->set($this->doFetchCurrent($point), $this->getCacheExpirationCurrent());
            $this->cache->save($item);
        }
        return $item->get();
    }

    /**
     * @api
     * @return Hourly
     */
    public function getHourly(Point $point)
    {
        $item = $this->cache->getItem($this->getCacheKeyHourly($point));
        if (true || !$item->exists()) {
            $item->set($this->doFetchHourly($point), $this->getCacheExpirationHourly());
            $this->cache->save($item);
        }
        return $item->get();
    }


    /**
     * @api
     *
     * @param string $units
     * @return $this
     */
    public function setUnits($units)
    {
        $this->units = $units;
        return $this;
    }

    /**
     * @param Point $point
     *
     * @internal
     * @return Current
     */
    abstract protected function doFetchCurrent(Point $point);

    /**
     * @param Point $point
     * @return Hourly
     */
    abstract protected function doFetchHourly(Point $point);

    /**
     * @param Point $point
     *
     * @internal
     * @return string
     */
    abstract protected function getCacheKeyCurrent(Point $point);

    /**
     * @param Point $point
     *
     * @internal
     * @return string
     */
    abstract protected function getCacheKeyHourly(Point $point);

    /**
     *
     * @internal
     * @return \DateTime
     */
    abstract protected function getCacheExpirationCurrent();

    /**
     *
     * @internal
     * @return \DateTime
     */
    abstract protected function getCacheExpirationHourly();



   /* abstract public function getDaily();

    abstract public function getHistory();*/
}
