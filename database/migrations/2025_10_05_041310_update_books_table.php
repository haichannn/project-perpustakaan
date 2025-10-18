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
        Schema::table('books', function (Blueprint $table) {

            // Update the title, author, and publisher columns to have a maximum length of 100 characters
            $table->string('title', 100)->notNullable()->change();
            $table->string('author', 100)->notNullable()->change();
            $table->string('publisher', 100)->notNullable()->change();

            // Update the ISNB column to allow null values
            $table->string('isbn', 17)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            // Revert the ISNB column to not allow null values
            $table->string('isbn')->nullable(false)->change();

            // Revert the title, author, and publisher columns to have a maximum length of 255 characters
            $table->string('title', 255)->notNullable()->change();
            $table->string('author', 255)->notNullable()->change();
            $table->string('publisher', 255)->notNullable()->change();
        });
    }
};
