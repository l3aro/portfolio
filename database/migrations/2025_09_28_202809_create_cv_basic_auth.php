<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = new User();
        $user->name = 'CV Basic Auth';
        $user->email = config('auth.cv.auth.username');
        $user->password = config('auth.cv.auth.password');
        $user->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        User::where('email', config('auth.cv.auth.username'))->delete();
    }
};
