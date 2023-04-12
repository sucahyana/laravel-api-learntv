<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumberColumnToMentorsTable extends Migration
{
    public function up()
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->integer('number')->nullable();
        });
    }

    public function down()
    {
        Schema::table('mentors', function (Blueprint $table) {
            $table->dropColumn('number');
        });
    }
}

