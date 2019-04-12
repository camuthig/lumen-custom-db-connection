<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\Credentials;
use App\Services\DistributedConfiguration;
use Illuminate\Console\Command;

class SeedConfiguration extends Command
{
    protected $signature = "configuration:seed";

    protected $description = "Seed test configuration values for the database connection";

    public function handle(DistributedConfiguration $configuration, Credentials $credentials)
    {
        $configuration->set('database.host', 'localhost');
        $configuration->set('database.port', 5432);
        $configuration->set('database.database', 'lumen');
        $configuration->set('database.charset', 'utf8');
        $configuration->set('database.prefix', '');
        $configuration->set('database.schema', 'public');

        $credentials->set('database.username', 'lumen');
        $credentials->set('database.password', 'lumen');
    }
}