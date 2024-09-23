<?php

namespace Modules\Invoice\Console;

use Illuminate\Console\Command;
use Modules\Invoice\Models\Subscription;
use Modules\Invoice\Notifications\SubscriptionReminder;

class SendRemindersCommand extends Command
{
    protected $signature = 'reminders:send';
    protected $description = 'Send reminders to clients whose subscriptions are overdue and need reminders';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = now();

        // Retrieve subscriptions that need reminders
        $subscriptions = Subscription::where('payment_status', 'unpaid')
                                     ->whereNotNull('next_reminder_date')
                                     ->where('next_reminder_date', '<=', $now)
                                     ->get();

        foreach ($subscriptions as $subscription) {
            if ($subscription->client) {
                // Pass both Client and Subscription to the SubscriptionReminder
                $subscription->client->notify(new SubscriptionReminder($subscription->client, $subscription));

                // Update the next reminder date
                $nextReminderDate = $now->copy()->addWeeks(2); // 2 weeks from now
                $subscription->update([
                    'next_reminder_date' => $nextReminderDate,
                ]);
            }
        }

        $this->info('Reminders have been sent successfully!');
    }
}
