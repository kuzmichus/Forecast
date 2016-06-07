<?php
declare(strict_types=1);
/**
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license MIT
 */

namespace Forecast;


use Cache\Taggable\TaggablePSR6PoolAdapter;
use Fig\Cache\Memory\MemoryPool;
use Forecast\Helper\Point;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\NullCacheItemPool;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Class WeatherAbstract
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */
abstract class WeatherAbstract
{
    /** @var \DateTime */
    protected $expiration = null;

    /**
     * @internal
     * @var TaggablePSR6PoolAdapter
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

    /** Нет осадков */
    const PRECIP_TYPE_NONE = 0;
    /** Дождь */
    const PRECIP_TYPE_RAIN = 1;
    /** Снег */
    const PRECIP_TYPE_SNOW = 2;
    /** Снег с дождём */
    const PRECIP_TYPE_SLEET = 3;
    /** Град */
    const PRECIP_TYPE_HAIL = 4;

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
        $this->cache = TaggablePSR6PoolAdapter::makeTaggable($cache ?: new MemoryPool());
        $this->logger = $logger ?: new NullLogger();


    }

    /**
     * Возвращает код языка
     *
     * @api
     *
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }

    /**
     * @api
     * @param string $lang
     */
    public function setLang(string $lang): self
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @api
     *
     * @return string
     */
    public function getUnits(): string
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
    public function getCurrent(Point $point): Current
    {
        $item = $this->cache->getItem($this->getCacheKeyCurrent($point));
        if (!$item->isHit()) {
            $current = $this->doFetchCurrent($point);
            $item
                ->set($current)
                ->expiresAt($this->getCacheExpirationCurrent())
                ->setTags(['weather']);

            $this->cache->save($item);
        }
        return $item->get();
    }

    /**
     * @api
     * 
     * @param Point $point
     * @param bool $forse
     * @return Hourly
     */
    public function getHourly(Point $point, bool $forse = false): Hourly
    {
        $item = $this->cache->getItem($this->getCacheKeyHourly($point));
        if ($forse || !$item->isHit()) {
            $item
                ->set($this->doFetchHourly($point))
                ->expiresAt($this->getCacheExpirationHourly())
                ->setTags(['weather']);
            $this->cache->save($item);
        }
        return $item->get();
    }

    /**
     * 
     */
    public function flushCache()
    {
        $this->cache->clearTags(['weather']);
    }


    /**
     * @api
     *
     * @param string $units
     * @return $this
     */
    public function setUnits(string $units): self
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

    public function calcDewPoint(float $h)
    {

    }
}
