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
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger(column: 'expertise_id');
            $table->primary(['lawyer_id', 'expertise_id']);
            $table->foreign('lawyer_id')->references('id')->on('lawyers');
            $table->foreign('expertise_id')->references('id')->on('expertises');
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
