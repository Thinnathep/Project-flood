<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('address');
            $table->string('phone_number');
            $table->string('status')->default('pending');
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 7);  // ฟิลด์ latitude
            $table->decimal('longitude', 10, 7); // ฟิลด์ longitude
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('requests');
    }
}

