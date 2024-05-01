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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            
            $table->foreignIdFor(\App\Models\User::class)->constrained();

            $table->string('meeting_subject');
            $table->date('meeting_date');
            $table->time("meeting_time");
            $table->string('attendee_one')->nullable();
            $table->string('attendee_two')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meetings');
    }
};
