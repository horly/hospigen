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
            $table->string('cle_licence');
            $table->date('date_debut');
            $table->date('date_expiration');
            //$table->boolean('est_active')->default(true);
            //$table->integer('nombre_utilisateurs')->default(1);
            $table->string('type_licence'); //standard => STDR, prenium => PREN, entreprise => ENTP
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
