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
            $table->string('name');
            // $table->string('no_telepon')->unique();
            $table->string('email')->unique();
            $table->text('password');
            $table->enum('level', ['admin', 'user'])->default('user');
            $table->integer('id_role')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->text('api_token')->nullable();
            $table->text('activation_token')->nullable();
            $table->integer('active')->default(0);
            $table->date('api_token_expires')->nullable();
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
        Schema::dropIfExists('users');
    }
}
