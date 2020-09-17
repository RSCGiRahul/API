<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Follower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->comment('user who is followed');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');


            
            $table->unsignedBigInteger('followed_by')->comment('user who follow');
            $table->foreign('followed_by')->references('id')->on('users')->onDelete('cascade');


            $table->timestamp('created_at')->default(DB::raw('now()'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('followers');
    }
}
