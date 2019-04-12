<?php

declare(strict_types=1);

namespace App\Database;

use App\Services\DistributedConfiguration;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Connectors\ConnectionFactory;

/**
 * A basic connection factory that works for Postgres and pulls configuration values from a Redis store.
 */
class CustomConnectionFactory extends ConnectionFactory
{
    /**
     * @var DistributedConfiguration
     */
    private $configuration;

    public function __construct(Container $container, DistributedConfiguration $configuration)
    {
        parent::__construct($container);

        $this->configuration = $configuration;
    }

    protected function parseConfig(array $config, $name)
    {
        return [
            'name' => $name,
            'driver' => 'pgsql',
            'prefix' => $this->configuration->get('database.prefix', ''),
            'host' => $this->configuration->get('database.host'),
            'port' => $this->configuration->get('database.port'),
            'database' => $this->configuration->get('database.database'),
            'username' => $this->configuration->get('database.username'),
            'password' => $this->configuration->get('database.password'),
            'charset' => $this->configuration->get('database.charset'),
            'schema' => $this->configuration->get('database.schema'),
        ];
    }
}