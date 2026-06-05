<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('agent_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('type', [
                'Appartement',
                'Villa',
                'Bureau',
                'Terrain',
                'Commerce'
            ]);

            $table->enum('transaction_type', [
                'Vente',
                'Location'
            ]);

            $table->decimal('surface', 10, 2);
            $table->decimal('price', 12, 2);

            $table->string('address');
            $table->string('district');

            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            $table->enum('status', [
                'Disponible',
                'Réservé',
                'Vendu-Loué',
                'Archivé'
            ])->default('Disponible');

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};