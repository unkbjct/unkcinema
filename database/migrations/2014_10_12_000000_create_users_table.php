<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->enum('role', ['ADMIN', 'USER']);
            $table->string('img', 300)->nullable();
            $table->string('cover', 300)->nullable();
            $table->string('login', 200)->unique();
            $table->string('email', 200)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'role' => 'ADMIN',
                'email' => 'admin@mail.ru',
                'login' => 'admin',
                'password' => '$2a$12$ZcIGC/IG4Xv2W/BgASPWSOFFetksvxrqC7hkds99Fgo2qX0Pp6yYu',
            )
        );
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
