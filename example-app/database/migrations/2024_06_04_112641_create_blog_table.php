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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Add title column
            $table->text('content'); // Add content column
            $table->timestamps(); // Add created_at and updated_at columns
            $table->mediumText('image')->nullable(); // Add image column for BLOB data
            $table->string('username'); // Add user column 
            $table->unsignedBigInteger('user_id'); // Corrected column definition for user_id
        
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
