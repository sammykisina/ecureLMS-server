<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('messages', function (Blueprint $table): void {
            $table->id();

            $table->text('body')->nullable();
            $table->boolean('read')
                ->default(0)
                ->nullable();
            $table->string('type')
                ->nullable();

            $table->foreignId('conversation_id')
                ->index()
                ->constrained()
                ->cascadeOnDelete();
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

            $table->timestamps();
        });
    }
};
