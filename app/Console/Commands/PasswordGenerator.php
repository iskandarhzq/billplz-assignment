<?php

namespace App\Console\Commands;

use App\Services\PasswordGenerator as PasswordGeneratorService;
use Illuminate\Console\Command;

class PasswordGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = PasswordGeneratorService::generate(12);

        $this->newLine();
        $this->info("Your random password is: $password");
        $this->newLine();
    }
}
