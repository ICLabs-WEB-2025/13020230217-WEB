<?php

    namespace App\Console\Commands;

    use App\Jobs\SendBookingReminder;
    use Illuminate\Console\Command;

    class SendBookingReminders extends Command
    {
        protected $signature = 'booking:send-reminders';
        protected $description = 'Mengirim pengingat untuk booking yang akan datang';

        public function handle()
        {
            SendBookingReminder::dispatch();
            $this->info('Pengingat booking telah dikirim.');
        }
    }