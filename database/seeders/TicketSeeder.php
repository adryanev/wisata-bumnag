<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::factory()->has(TicketSetting::factory()->perPax())->count(50)->create();
        Ticket::factory()->has(TicketSetting::factory()->perDay())->count(50)->create();
        Ticket::factory()->has(TicketSetting::factory()->perAge())->count(50)->create();
    }
}
