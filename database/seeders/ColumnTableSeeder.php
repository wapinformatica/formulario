<?php

namespace Database\Seeders;

use App\Models\Column;
use Illuminate\Database\Seeder;

class ColumnTableSeeder extends Seeder
{
    public function run()
    {
        Column::updateOrCreate(
            ['name_table' => 'candidatos', 'name_column' => 'Nome'],
            ['updated_at' => now()]
        );
    }
}
