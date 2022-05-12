<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('role_id')->references('id')->on('role')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('permission_id')->references('id')->on('permission_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_roles');
    }
};
