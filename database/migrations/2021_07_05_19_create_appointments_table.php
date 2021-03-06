<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->text('bookdate');
            $table->date('date');
            $table->text('start_time');
            $table->text('end_time');
            $table->tinyInteger('status')->default(0)->comment('0->waiting , 1->accepted , 2->refused , 3-canceled by user');
            $table->foreignId('user_id')->constrained()->OnUpdate('cascade')->onDelete('cascade');
            $table->foreignId('clinic_id')->constrained()->OnUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('appointments');
    }
}
