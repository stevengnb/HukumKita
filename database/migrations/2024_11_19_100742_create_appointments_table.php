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
        Schema::create('appointments', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger(column: 'user_id');
            $table->primary(['lawyer_id', 'user_id']);
            $table->foreign('lawyer_id')->references('id')->on('lawyers')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('dateTime');
            $table->string('address');
            $table->decimal('rating')->nullable();
            $table->string('review')->nullable();
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
