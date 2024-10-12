<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('water_reports', function (Blueprint $table) {
            $table->id();
            $table->string('location');
            $table->enum('water_source_type', ['river', 'flood_area']);
            $table->string('water_source_name');
            $table->float('water_level');
            $table->text('description')->nullable();
            $table->enum('status', ['normal', 'warning', 'danger']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_reports');
    }
};
