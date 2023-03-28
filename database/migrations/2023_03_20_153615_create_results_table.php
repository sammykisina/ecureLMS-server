<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('results', function (Blueprint $table): void {
            $table->id();

            $table->integer(column: 'points');

            $table->foreignId(column: 'task_id')
                ->index()
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->unsignedBigInteger(column: 'student_id');
            $table->foreign(columns:'student_id')
                ->references(columns: 'id')
                ->on(table: "users")
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
