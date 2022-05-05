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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('receiver_user_id')->nullable();
            $table->bigInteger('sender_user_id')->nullable();
            $table->string('status');
            $table->decimal('begin_balance')->nullable();
            $table->decimal('amount')->default(0.00);
            $table->decimal('end_balance')->nullable();
            $table->string('reference')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
