<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->foreignId('address_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->unsignedInteger('grand_total');
            $table->enum('status', ['processing', 'canceled', 'sending', 'success'])
                ->default('processing');
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('user_addresses')
                ->nullOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
