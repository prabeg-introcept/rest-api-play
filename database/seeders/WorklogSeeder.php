<?php

namespace Database\Seeders;

use App\Models\Worklog;
use Illuminate\Database\Seeder;

class WorklogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Worklog::factory()
            ->count(15)
            ->forUser([
                'username' => 'Prabeg Shakya'
            ])
            ->create();
    }
}
