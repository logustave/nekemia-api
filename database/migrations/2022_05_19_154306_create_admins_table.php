<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('role_id')->nullable()->references('id')->on('roles')->nullOnDelete()->cascadeOnUpdate();
            $table->string('full_name');
            $table->string('pseudo')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('contact','15')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->dateTime('password_change_at')->default(null)->nullable();
            $table->string('password');
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
        Schema::dropIfExists('admins');
    }
}
