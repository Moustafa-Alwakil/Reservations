<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('email')->unique();
            $table->string('phone',20)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(0)->comment('0->not verified , 1-> verified , 2->banned');
            $table->string('password');
            $table->smallInteger('code');
            $table->string('gender',1)->comment('m->male , f->female');
            $table->date('birthdate');
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
        Schema::dropIfExists('patients');
    }
}
