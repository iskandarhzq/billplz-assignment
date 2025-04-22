<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SnailClimbDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'snail:climb-days';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'How many days can snail climb from a well?';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = $this->daysSnailClimb();

        $this->newLine();
        $this->info("$days days for a snail to climb the well.");
        $this->newLine();
    }

    public function daysSnailClimb($wellHeight = 11, $climb = 3, $slip = 2)
    {
        $height = 0;
        $days = 0;

        while (true) {
            $days++;
            $height += $climb;

            if ($height >= $wellHeight) {
                return $days;
            }

            $height -= $slip;
        }
    }
}
