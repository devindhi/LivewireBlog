<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->text('comment'); // Add content column
            $table->unsignedBigInteger('user_id'); // Corrected column definition for user_id
            $table->text('username'); // Add username column
            $table->unsignedBigInteger('blog_id'); // Add blog_id column
            $table->timestamps(); // Add created_at and updated_at columns

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};