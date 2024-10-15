<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id('customer_id'); // Usar 'customer_id' como clave primaria
        $table->string('name');
        $table->string('phone')->nullable();
        $table->string('email')->nullable()->unique();
        $table->text('address')->nullable();
        $table->boolean('status')->default(1); // 1 para activo, 0 para inactivo
        $table->timestamps(); // Incluye created_at y updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
