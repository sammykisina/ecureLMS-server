<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('answers', function (Blueprint $table): void {
            $table->id();

            $table->string(column: 'identity');
            $table->string(column: 'answer');

            $table->foreignId(column: 'question_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
