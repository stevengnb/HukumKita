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
        Schema::create('appointments', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('lawyerId');
            $table->unsignedBigInteger(column: 'userId');
            $table->primary(['lawyerId', 'userId']);
            $table->foreign('lawyerId')->references('id')->on('lawyers');
            $table->foreign('userId')->references('id')->on('users');
            $table->date('date');
            $table->string('address');
            $table->decimal('rating');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
