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
        Schema::create('licence_historiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('licence_id')->nullable()->references('id')->on('licences')->nullOnDelete()->cascadeOnUpdate();
            $table->string('action');
            $table->timestamp('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licence_historiques');
    }
};
