<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table): void {
            $table->id();
            $table->string(column: 'code');

            $table->string(column: 'description');
            $table->string(column: 'icon');
            $table->string(column: 'bgColor');
            $table->integer(column: 'numberOfQuestions');
            $table->integer(column: 'numberOfPointsForEachQuestion');
            $table->integer(column: 'timeToTakeInTask');
            $table->integer(column: 'numberOfValidDays');
            $table->boolean(column: 'published')->default(value: false);

            $table->unsignedBigInteger(column: 'lecturer_id');
            $table->foreign(columns:'lecturer_id')
                ->references(columns: 'id')
                ->on(table: "users");

            $table->foreignId(column: 'unit_id')
                ->index()
                ->constrained();

            $table->timestamp(column: 'dueDate')->nullable();
            $table->timestamps();
        });
    }
};
