<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->date('createDate');
            // $table->string('imagePath');
            $table->unsignedBigInteger('lawyer_id');
            $table->foreign('lawyer_id')->on('lawyers')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('expertise_id');
            $table->foreign('expertise_id')->references('id')->on('expertises')->onUpdate('cascade')->onDelete('cascade');
        });

        DB::statement("ALTER TABLE articles ADD imagePath MEDIUMBLOB");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
