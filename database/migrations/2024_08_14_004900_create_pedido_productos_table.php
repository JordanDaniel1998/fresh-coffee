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
        Schema::create('pedido_productos', function (Blueprint $table) {
            $table->id();
            // Si un pedido se elimina entonces se elimina el pedido_producto
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            // Si un producto se elimina entonces se elimina el pedido_producto
            $table->foreignId('producto_id')->constrained()->onDelete('cascade');
            $table->integer('cantidad')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_productos');
    }
};
