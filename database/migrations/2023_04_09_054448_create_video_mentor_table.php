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
        Schema::create('video_mentor', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mentor');
            $table->string('basprog');
            $table->string('judul');
            $table->string('link_video');
            $table->timestamps();

            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('basprog_id');

            $table->foreign('author_id')->references('id')->on('mentor');
            $table->foreign('basprog_id')->references('id')->on('mentor');

            $table->softDeletes();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_mentor');
    }
};
