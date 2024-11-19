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
        Schema::create('lawyers_expertises', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedBigInteger('lawyerId');
            $table->unsignedBigInteger(column: 'expertiseId');
            $table->primary(['lawyerId', 'expertiseId']);
            $table->foreign('lawyerId')->references('id')->on('lawyers');
            $table->foreign('expertiseId')->references('id')->on('expertises');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyers_expertises');
    }
};
