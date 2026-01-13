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
        Schema::create('translators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->index(); // Added for SEO
            // you cannot delete a language entry as long as there is a translator associated with it
            $table->foreignId('native_language_id')
                ->nullable() 
                ->constrained('languages')
                ->restrictOnDelete(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translators');
    }
};
