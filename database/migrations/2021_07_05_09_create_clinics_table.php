<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('phone',20);
            $table->tinyInteger('status')->default(0)->comment('0->not active , 1->active');
            $table->string('license');
            $table->tinyInteger('review')->default(2)->comment('0->not accepted , 1->accepted , 2->waiting');
            $table->foreignId('physican_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('clinics');
    }
}
