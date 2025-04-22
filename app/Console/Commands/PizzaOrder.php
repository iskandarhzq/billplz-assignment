<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PizzaOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:pizza';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Simple pizza ordering';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->newLine(2);
        $this->line('Welcome To Pizza Sedap!');
        $this->line('We have three sizes of pizza; Small (RM15), Medium (RM22), Large (RM30)');
        $pizzaSizes = $this->choice(
            'Choose your pizza size? (can more than one, separate by commas)',
            ['small', 'medium', 'large'],
            0,
            null,
            true
        );

        $pizzaAdditions = [];
        if ($this->confirm('We too have add-ons, would you like to add-ons?', true)) {
            $this->line('Nice! These are the add-ons:');
            $this->line('1. [PSP] Pepperoni for small pizza: +RM3');
            $this->line('2. [PMP] Pepperoni for medium pizza: +RM5');
            $this->line('3. [EC] Extra cheese for any size pizza: +RM6');

            $pizzaAdditions = $this->choice(
                'Choose your add-ons? (can more than one, separate by commas)',
                ['psp', 'pmp', 'ec'],
                0,
                null,
                true
            );
        }

        $finalBill = $this->finalBill($pizzaSizes, $pizzaAdditions);

        $this->info('This is your final bill: RM'.$finalBill);
    }

    public function finalBill($pizzaSizes, $pizzaAdditions = [])
    {
        $sizes = [
            'small' => 15,
            'medium' => 22,
            'large' => 30,
        ];

        $additions = [
            'psp' => 3,
            'pmp' => 5,
            'ec' => 6,
        ];

        $bill = 0;

        $this->line('These are your pizza orders:');

        foreach ($pizzaSizes as $pizzaSize) {
            $this->line('- '.ucwords($pizzaSize).' Pizza: RM'.$sizes[$pizzaSize]);
            $bill += $sizes[strtolower($pizzaSize)];
        }

        if (count($pizzaAdditions) > 0) {
            $this->newLine();
            $this->line('These are the add-ons:');
            foreach ($pizzaAdditions as $pizzaAddition) {
                if (in_array('small', $pizzaSizes) && strtolower($pizzaAddition) === 'psp') {
                    $this->line('- PSP: +RM3');
                    $bill += $additions[$pizzaAddition];
                }

                if (in_array('medium', $pizzaSizes) && strtolower($pizzaAddition) === 'pmp') {
                    $this->line('- PMP: +RM5');
                    $bill += $additions[$pizzaAddition];
                }

                if (strtolower($pizzaAddition) === 'ec') {
                    $this->line('- Extra Cheese: +RM6');
                    $bill += $additions[$pizzaAddition];
                }
            }
        }

        return $bill;
    }
}
