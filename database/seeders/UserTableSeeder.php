<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Traints\RootTableSeeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    use RootTableSeeder;

    public function run()
    {
        $users = [
            [
                'name' => 'Administrador',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin1234'),
                'email_verified_at' => now(),
            ]
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $this->rootTableSeeder($user->id);
        }
    }
}
