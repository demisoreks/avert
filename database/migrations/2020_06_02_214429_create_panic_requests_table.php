<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanicRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avt_panic_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 50)->nullable();
            $table->string('first_name', 100);
            $table->string('surname', 100);
            $table->date('date_of_birth');
            $table->string('gender', 10);
            $table->text('home_address');
            $table->string('primary_phone', 20);
            $table->string('alternate_phone', 20)->nullable();
            $table->string('email', 100);
            $table->string('occupation', 100)->nullable();
            $table->string('status', 100);
            $table->text('comment')->nullable();
            $table->datetime('treated_at')->nullable();
            $table->integer('treated_by')->nullable();
            $table->string('username', 100)->nullable();
            $table->string('password', 100)->nullable();
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
        Schema::dropIfExists('avt_panic_requests');
    }
}
