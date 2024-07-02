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
        Schema::table('materiels', function (Blueprint $table) {
            $table->foreignId('departement_id')->nullable()->references('id')->on('departements')->nullOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materiels', function (Blueprint $table) {
            $table->dropConstrainedForeignId('departement_id');
        });
    }
};
