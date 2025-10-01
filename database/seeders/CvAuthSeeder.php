<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CvAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = 'CV Basic Auth';
        $user->email = config('auth.cv.auth.username');
        $user->password = config('auth.cv.auth.password');
        $user->save();
    }
}
