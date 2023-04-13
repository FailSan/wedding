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
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->char('password', 8);
            $table->ulid('code')->unique();
            $table->string('diet')->default('nessuna');
            $table->string('allergies')->default('nessuna');
            $table->boolean('church_confirm')->default(0);
            $table->boolean('castle_confirm')->default(0);
            $table->boolean('updated')->default(0);
            $table->foreignId('guest_id')->nullable()->constrained()->cascadeOnUpdate()->nullOnDelete();
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
        Schema::dropIfExists('guests');
    }
};
