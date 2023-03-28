<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('conversations', function (Blueprint $table): void {
            $table->id();

            $table->unsignedBigInteger('senderId');
            $table->foreign('senderId')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->unsignedBigInteger('receiverId');
            $table->foreign('receiverId')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->timestamp('lastTimeMessage')
                    ->nullable()
                    ->default(value: now());
            $table->timestamps();
        });
    }
};
