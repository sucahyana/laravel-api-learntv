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
        Schema::create('streams', function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('title');
            $table->string('code_id');
            $table->unsignedBigInteger('mentor_id');
            $table->string('name');
            $table->string('category');
            $table->string('link');
            $table->string('thumbnail');

            $table->foreign('mentor_id')->references('id')->on('mentors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streams');
    }
};
