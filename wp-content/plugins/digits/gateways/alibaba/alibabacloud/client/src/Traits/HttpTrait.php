<?php

namespace AlibabaCloud\Client\Traits;

use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Filter\ClientFilter;
use function AlibabaCloud\Client\arrayMerge;

/**
 * Trait HttpTrait
 *
 * @package AlibabaCloud\Client\Traits
 */
trait HttpTrait
{

    /**
     * @var array
     */
    public $options = [];

    /**
     * @param int|float $timeout
     *
     * @return $this
     * @throws ClientException
     */
    public function timeout($timeout)
    {
        $this->options['timeout'] = ClientFilter::timeout($timeout);

        return $this;
    }

    /**
     * @param int|float $connectTimeout
     *
     * @return $this
     * @throws ClientException
     */
    public function connectTimeout($connectTimeout)
    {
        $this->options['connect_timeout'] = ClientFilter::connectTimeout($connectTimeout);

        return $this;
    }

    /**
     * @param bool $debug
     *
     * @return $this
     */
    public function debug($debug)
    {
        $this->options['debug'] = $debug;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array $cert
     *
     * @return $this
     */
    public function cert($cert)
    {
        $this->options['cert'] = $cert;

        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array|string $proxy
     *
     * @return $this
     */
    public function proxy($proxy)
    {
        $this->options['proxy'] = $proxy;

        return $this;
    }

    /**
     * @param mixed $verify
     *
     * @return $this
     */
    public function verify($verify)
    {
        $this->options['verify'] = $verify;

        return $this;
    }

    /**
     * @param array $options
     *
     * @return $this
     */
    public function options(array $options)
    {
        if ($options !== []) {
            $this->options = arrayMerge([$this->options, $options]);
        }

        return $this;
    }
}
