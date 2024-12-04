<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference_number')->unique()->nullable();
            $table->string('name');
            $table->string('birthplace');
            $table->date('birthdate');
            $table->enum('gender', ['male', 'female']);
            $table->string('address');
            $table->string('phone')->nullable();
            $table->enum('citizen', ['WNI', 'WNA']);
            $table->string('profession');
            $table->string('police_station');
            $table->string('reference_police_number');
            $table->dateTime('report_date_time');
            // $table->timestamp('report_date_time');
            $table->text('content');
            $table->foreignUuid('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
