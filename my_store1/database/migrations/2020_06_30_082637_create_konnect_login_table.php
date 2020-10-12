<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonnectLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konnect_login', function (Blueprint $table) {
            $table->increments('login_id');
            $table->string('login_name');
            $table->string('login_uname');
            $table->string('login_pass');
            $table->string('login_mobile');
            $table->string('login_email')->unique();
            $table->string('login_contact_person')->nullable();
            $table->string('login_landline')->nullable();
            $table->string('login_address')->nullable();
            $table->string('login_pincode')->nullable();
            $table->string('login_city')->nullable();
            $table->string('login_state')->nullable();
            $table->string('login_website')->nullable();
            $table->string('login_logo')->nullable();
            $table->string('login_user_type')->nullable();
            $table->string('login_registration_date')->nullable();
            $table->integer('login_status')->unsigned()->defualt(1);
            $table->integer('user_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konnect_login');
    }
}
