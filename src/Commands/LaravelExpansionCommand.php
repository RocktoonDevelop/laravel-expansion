<?php

namespace Rocktoon\LaravelExpansion\Commands;

use Illuminate\Console\Command;

class LaravelExpansionCommand extends Command
{
    public $signature = 'laravel-expansion';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
