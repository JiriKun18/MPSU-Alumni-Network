<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumni_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->enum('status', ['registered', 'attended', 'cancelled'])->default('registered');
            $table->text('additional_info')->nullable();
            $table->timestamps();

            $table->unique(['alumni_id', 'event_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
}
