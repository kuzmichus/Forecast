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
use GuzzleHttp\Subscriber\Log\Formatter;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Log\LoggerInterface;

/**
 * Получение информации о погоде с сервиса forecast.io.
 *
 * Для работы необходимо получить key на сайте https://developer.forecast.io
 *
 * PHP version 5.5
 *
 * @package Forecast
 * @author  Sergey V.Kuzin <sergey@kuzin.name>
 * @license http://opensource.org/licenses/MIT The MIT License (MIT)
 *
 */
class ForecastIO extends WeatherAbstract
{
    /**
     * @var string
     */
    protected $apiKey = null;
    protected $pint = null;

    /** @var \DateTime */
    protected $expiration = null;

    /**
     * Полу
     *
     * @param string $apiKey Ключ получченный на https://developer.forecast.io/
     *       Получить ключь можно бесплатно. Каждому дано 100 бесплатных запров в день к серверу.
     * @param CacheItemPoolInterface|null $cache Экземпляра класса кэширования по стандарту PSR-6
     * @param LoggerInterface|null $logger Экземляр класса логера сандарта PSR-3
     *
     * @api
     */
    public function __construct($apiKey, CacheItemPoolInterface $cache = null, LoggerInterface $logger = null)
    {
        $this->apiKey = $apiKey;
        parent::__construct($cache, $logger);
    }

    protected function doFetchAll(Point $point)
    {
        if ($point->getType() == Point::ADDRESS) {
            throw new \InvalidArgumentException();
        }

        $key = 'weather.fc.io-all-' . md5(serialize([$this->getLang(), $this->getUnits(), $point->getKey()]));
        $item = $this->cache->getItem($key);
        if (!$item->exists()) {
            $params = [
                'units' => $this->getUnits(),
                'lang' => $this->getLang(),
                'exclude' => 'flags'
            ];
            $url = 'https://api.forecast.io/forecast/' . $this->apiKey . '/' . $point->getLatitude() . ',' . $point->getLongitude();

            $client = new \GuzzleHttp\Client();

            $response = $client->get($url, ['debug' => false, 'query' => $params]);

            $result = json_decode($response->getBody()->getContents(), true);

            if ($result !== null) {
                list($n, $exp) = explode('=', $response->getHeader('Cache-Control'));
                $item->expiresAfter($exp);
                $item->set($result);
                $item->expiresAfter($exp);
                $this->cache->save($item);
            }
        }
        $this->expiration = $item->getExpiration();
        return $item->get();
    }

    /**
     * @internal
     * @return \Forecast\Current
     */
    protected function doFetchCurrent(Point $point)
    {
        if ($point->getType() == Point::ADDRESS) {
            throw new \InvalidArgumentException();
        }
        $result = $this->doFetchAll($point);
        $result = $result['currently'];

        $cur = new Current();

        $precipType = self::PRECIP_TYPE_NONE;
        if ($result['precipProbability'] > 0) {
            switch ($result['precipType']) {
                case 'rain':
                    $precipType = self::PRECIP_TYPE_RAIN;
                    break;
                case 'snow':
                    $precipType = self::PRECIP_TYPE_SNOW;
                    break;
                case 'sleet':
                    $precipType = self::PRECIP_TYPE_SLEET;
                    break;
                case 'hail':
                    $precipType = self::PRECIP_TYPE_HAIL;
                    break;
                default:
                    throw new \Exception('Не известный тип precipType: ' . $result['precipType']);
            }
        }
        $cur->setData([
            'summary' => $result['summary'],
            'temperature' => [
                'current' => $result['temperature'],
                'apparent' => $result['apparentTemperature']
            ],
            'wind' => [
                'speed' => $result['windSpeed'],
                'degree' => $result['windBearing'],
            ],
            'precipitation' => [
                'intensity' => $result['precipIntensity'],
                'probability' => $result['precipProbability'] * 100,
                'type' => $precipType,
            ],
            'humidity' => [
                'humidity' => $result['humidity']
            ]
        ]);

        return $cur;
    }

    /**
     * @param Point $point Класс с коорденатами места для которой запрашивается погода
     * @internal
     * @return string
     */
    protected function getCacheKeyCurrent(Point $point)
    {
        return 'weather.fc.io-current-' . md5(serialize([$this->getLang(), $this->getUnits(), $point->getKey()]));
    }

    /**
     * @internal
     * @return \DateTime
     */
    protected function getCacheExpirationCurrent()
    {
        return $this->expiration;
    }

    /**
     * @param Point $point
     * @return Hourly
     */
    protected function doFetchHourly(Point $point)
    {
        if ($point->getType() == Point::ADDRESS) {
            throw new \InvalidArgumentException();
        }

        $result = $this->doFetchAll($point);
        $result = $result['hourly'];

        $hours = [];
        foreach ($result['data'] as $item) {
            $precipType = self::PRECIP_TYPE_NONE;
            if ($item['precipProbability'] > 0) {
                switch ($item['precipType']) {
                    case 'rain':
                        $precipType = self::PRECIP_TYPE_RAIN;
                        break;
                    case 'snow':
                        $precipType = self::PRECIP_TYPE_SNOW;
                        break;
                    case 'sleet':
                        $precipType = self::PRECIP_TYPE_SLEET;
                        break;
                    case 'hail':
                        $precipType = self::PRECIP_TYPE_HAIL;
                        break;
                    default:
                        throw new \Exception('Не известный тип precipType: ' . $item['precipType']);
                }
            }

            $hours[] = [
                'summary'   => $item['summary'],
                'date' => new \DateTime(date(\DateTime::RFC3339, $item['time'])),
                'temperature' => [
                    'current' => $item['temperature'],
                    'apparent' => $item['apparentTemperature']
                ],
                'wind' => [
                    'speed' => $item['windSpeed'],
                    'degree' => $item['windBearing'],
                ],
                'precipitation' => [
                    'intensity' => $item['precipIntensity'],
                    'probability' => $item['precipProbability'] * 100,
                    'type' => $precipType,
                ],
                'humidity' => [
                    'humidity' => $item['humidity']
                ],
                'icon'  => $item['icon']
            ];
        }

        $hourly = new Hourly();
        $hourly->setData([
            'summary' => $result['summary'],
            'hours' => $hours
        ]);

        return $hourly;
    }

    /**
     * @param Point $point
     *
     * @internal
     * @return string
     */
    protected function getCacheKeyHourly(Point $point)
    {
        return 'weather.fc.io-hourly-' . md5(serialize([$this->getLang(), $this->getUnits(), $point->getKey()]));
    }

    /**
     *
     * @internal
     * @return \DateTime
     */
    protected function getCacheExpirationHourly()
    {
        return $this->expiration;
    }
}
