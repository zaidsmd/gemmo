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
        Schema::create('licences', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_achat')->nullable();
            $table->date('date_expiration')->nullable();
            $table->string('prix_achat')->nullable();
            $table->string('quantite')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('materiel_id')->nullable()->references('id')->on('materiels')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('departement_id')->nullable()->references('id')->on('departements')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('locale_id')->nullable()->references('id')->on('locales')->nullOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licences');
    }
};
