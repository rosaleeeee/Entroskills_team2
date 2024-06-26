<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMbtiDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('mbti_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('E_start')->default(0);
            $table->integer('I_start')->default(0);
            $table->integer('S_start')->default(0);
            $table->integer('N_start')->default(0);
            $table->integer('T_start')->default(0);
            $table->integer('F_start')->default(0);
            $table->integer('J_start')->default(0);
            $table->integer('P_start')->default(0);
            $table->integer('E_level4')->default(0);
            $table->integer('I_level4')->default(0);
            $table->integer('S_level4')->default(0);
            $table->integer('N_level4')->default(0);
            $table->integer('T_level4')->default(0);
            $table->integer('F_level4')->default(0);
            $table->integer('J_level4')->default(0);
            $table->integer('P_level4')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mbti_details');
    }
}
