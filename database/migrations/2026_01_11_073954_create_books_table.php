<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique()->index();
            $table->text('description')->nullable();

            // Use decimal for prices (8 digits total, 2 after the decimal)
            $table->decimal('price', 8, 2);

            //relationships with author_id, you can delete an author while their books remain
            //but their author_id field will be set to null
            $table->foreignId('author_id')->
            nullable()->
            constrained('authors')->nullOnDelete();

            // Relationship with Translator (Set Null on Delete)
            $table->foreignId('translator_id')
                ->nullable()
                ->constrained('translators')
                ->nullOnDelete();

            // Relationship with Language (The book's primary language)
            $table->foreignId('language_id')
                ->nullable()
                ->constrained('languages')
                ->restrictOnDelete();

            $table->integer('stock_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
