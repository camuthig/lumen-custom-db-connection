<?php

namespace App\Services;

use Predis\ClientInterface;

/**
 * A sample class that pulls credentials from something besides our local configurations.
 *
 * In reality this might be a HTTP call to some other service or pulling it from some encrypted source. The details of
 * that really aren't important, just that we have to pull these values from somewhere besides the local configurations
 * and the DistributedConfiguration.
 */
class Credentials
{
    public function get(string $key, $default = null)
    {
        /** @var ClientInterface $redis */
        $redis = app('redis');

        return $redis->get('secure.' . $key) ?? $default;
    }

    public function set(string $key, $value): void
    {
        /** @var ClientInterface $redis */
        $redis = app('redis');

        $redis->set('secure.' . $key, $value);
    }
}