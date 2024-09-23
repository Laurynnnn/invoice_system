<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Modules\Invoice\Console\SendInvoicesCommand;
use Modules\Invoice\Console\SendRemindersCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(SendInvoicesCommand::class)->daily();
Schedule::command(SendRemindersCommand::class)->daily();

