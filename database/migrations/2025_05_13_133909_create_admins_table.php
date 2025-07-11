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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->foreignId('club_id')
                  ->constrained()
                  ->onDelete('cascade');

            $table->string('full_name');
            $table->string('admin_email')->unique();
            $table->string('admin_phone')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->boolean('terms')->default(false)->nullable();
            $table->enum('role',['admin']);
            $table->string('sexe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
