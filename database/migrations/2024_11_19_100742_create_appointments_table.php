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
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger(column: 'user_id');
            $table->primary(['lawyer_id', 'user_id']);
            $table->foreign('lawyer_id')->references('id')->on('lawyers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date');
            $table->string('address');
            $table->decimal('rating');
            $table->string('review');
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
