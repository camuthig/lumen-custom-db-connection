<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\DistributedConfiguration;
use Illuminate\Console\Command;

class SetConfiguration extends Command
{
    protected $signature = 'configuration:set 
                            {key : The key of the configuration value} 
                            {value : The value of the configuraiton key}';

    protected $description = 'Set a basic configuration value in the distributed configuration';

    public function handle(DistributedConfiguration $configuration)
    {
        $configuration->set($this->argument('key'), $this->argument('value'));

        $this->info('Done!');
    }
}