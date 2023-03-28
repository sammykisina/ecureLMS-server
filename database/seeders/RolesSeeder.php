<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

final class RolesSeeder extends Seeder {
    public function run(): void {
        Schema::disableForeignKeyConstraints();
        DB::table('roles')->truncate();
        Schema::enableForeignKeyConstraints();

        $roles = [
            ['name' => 'Administrator', 'slug' => 'admin'],
            ['name' => 'Lecturer', 'slug' => 'lecturer'],
            ['name' => 'Student', 'slug' => 'student'],
        ];

        collect($roles)->each(function ($role) {
            Role::create($role);
        });
    }
}
