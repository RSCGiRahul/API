<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid('fb_id');
            $table->string('username');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            
            $table->char('gender',10)->comment('1-Male,2-Female');
            $table->text('bio')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('block')->default(0);
            $table->char('version', 5)->nullable();
            $table->char('device', 15)->nullable();
            $table->char('signup_type', 20)->nullable();
            $table->string('profile_pic')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
