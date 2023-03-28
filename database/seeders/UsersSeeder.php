<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $admin = Role::query()->where('slug', 'admin')->first();
        User::create([
            'regNumber' => '34996980',
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make(value: 'admin'),
            'role_id' => $admin->id,
        ]);
    }
}
