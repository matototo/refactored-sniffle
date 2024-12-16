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
        Schema::create('bouteille', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            // $table->string('type');
            // $table->string('pays');
            // $table->string('region');
            // $table->string('appellation');
            // $table->string('couleur');
            // $table->string('particularite');
            // $table->string('format');
            // $table->string('producteur');
            // $table->string('agent_promotionnel');
            // $table->float('degree_alcool', 100);
            // $table->string('taux_de_sucre');
            // $table->string('classification');
            // $table->string('cepages');
            $table->string('prix');
            $table->string('identity');
            // $table->decimal('prix', 10, 2);
            // $table->string('url_image');
            // $table->integer('quantite');
            // $table->string('milissime_degustation');
            // $table->string('aromes');
            // $table->string('temperature_service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bouteille');
    }
};
