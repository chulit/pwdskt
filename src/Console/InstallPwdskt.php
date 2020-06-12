<?php

namespace Diskominfotik\Pwdskt\Console;

use Illuminate\Console\Command;

class InstallPwdskt extends Command
{
    protected $signature = 'pwdskt:publish';
    protected $description = 'Publish config the Pwdskt';

    public function handle()
    {
        $this->info('Publishing configuration...');
        $this->call('vendor:publish', [
            '--provider' => "Diskominfotik\Pwdskt\PwdsktServiceProvider",
            '--tag' => "config"
        ]);
        $this->info('Configuration published');
    }
}
