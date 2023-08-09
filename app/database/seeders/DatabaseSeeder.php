<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create([
            'password' => bcrypt('12345678')
        ]);
        for ($i=1; $i <=10; $i++) { 
            \App\Models\Ticket::create([
                'start_location' => random_int(1,10),
                'end_location' => random_int(1,10),
                'type_id' => random_int(1,10),
                'tax' => random_int(1,100),
                'airline_company_id' => random_int(1,10),
                'start_time' => Carbon::now(),
                'price' => random_int(1,10000000),
                'fee' => random_int(1,10000000),
                'flight_number' => random_int(1,10000000)
            ]);
            \App\Models\TicketType::create([
                'name' => 'type ' . $i
            ]);
            \App\Models\Location::create([
                'name' => 'location ' . $i
            ]);
            \App\Models\AirlineCompany::create([
                'name' => 'AirlineCompany ' . $i
            ]);
        }
    }
}
