<?php

namespace Modules\Invoice\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BillingCycleAmountsSeeder extends Seeder
{
    public function run()
    {
        DB::table('billing_cycle_amounts')->insert([
            ['billing_cycle_years' => '1 year', 'amount' => 1000.00],
            ['billing_cycle_years' => '2 years', 'amount' => 1800.00],
            ['billing_cycle_years' => '5 years', 'amount' => 4000.00],
        ]);
    }
}
