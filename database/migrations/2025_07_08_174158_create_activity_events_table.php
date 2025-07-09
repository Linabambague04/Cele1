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
<<<<<<< Updated upstream:database/migrations/2025_07_08_174158_create_activity_events_table.php
        Schema::create('activity_events', function (Blueprint $table) {
            $table->id();         
            $table->string('activity_type', 50);
            $table->string('status', 20);
=======
        Schema::create('activity_event', function (Blueprint $table) {
            $table->id();
>>>>>>> Stashed changes:database/migrations/2025_07_03_010916_create_activity_event_table.php
            $table->unsignedBigInteger('event_id');
            $table->foreignId('event_id')
                ->constrained('events')
                ->onDelete('cascade')
                ->comment('Referencia al evento relacionado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_events');
    }
};
