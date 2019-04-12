<?php

namespace App\Services;

use Predis\ClientInterface;

class DistributedConfiguration
{
    public function get(string $config, $default = null)
    {
        /** @var ClientInterface $redis */
        $redis = app('redis');

        return $redis->get($config) ?? $default;
    }

    public function set(string $config, $value): void
    {
        /** @var ClientInterface $redis */
        $redis = app('redis');

        $redis->set($config, $value);
    }
}