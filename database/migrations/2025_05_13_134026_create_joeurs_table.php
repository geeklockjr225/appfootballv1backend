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
        Schema::create('joeurs', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('avatar')->nullable();
            $table->string('terms')->default('true')->nullable();
            $table->string('sexe');
            $table->date('date_de_naissance');
            $table->string('classe');
            $table->string('antecedent');
            $table->string('categorie');
            $table->string('taille');
            $table->string('poids');
            $table->string('position');
            $table->timestamps();

            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('parents')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joeurs');
    }
};
