<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lecturer_unit', function (Blueprint $table): void {
            $table->unsignedBigInteger(column: 'lecturer_id');
            $table->foreign(columns:'lecturer_id')
                ->references(columns: 'id')
                ->on(table: "users");

            $table->unsignedBigInteger(column: 'unit_id');
            $table->foreign(columns:'unit_id')
                ->references(columns: 'id')
                ->on(table: "units");
        });
    }
};
