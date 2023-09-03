<?php

namespace Database\Seeders;

use App\Models\Consultant;
use Illuminate\Database\Seeder;

class ConsultantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Consultant::get()->count() < 100) {
            Consultant::factory(100)->create();
        }
    }
}
