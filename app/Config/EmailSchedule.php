<?php

namespace Config;

use App\Commands\SendEmail;

class EmailSchedule
{
    public function __construct()
    {
        // Menggunakan sintaks chaining untuk menjadwalkan command SendEmail
        $this->sendEmail();
    }

    protected function sendEmail()
    {
        // Menjadwalkan command SendEmail untuk dijalankan setiap menit
        $schedule = \Config\Services::scheduler();
        $schedule->command(SendEmail::class)->everyMinute();
    }
}
