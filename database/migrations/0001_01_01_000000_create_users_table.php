<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username', 30)->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('bio')->nullable();
            $table->string('website')->nullable();
            $table->string('profile_photo_path')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Creates the follow relationship table
        Schema::create('follows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('followed_user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            // Prevent duplicate follows
            $table->unique(['user_id', 'followed_user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('users');
    }
};
