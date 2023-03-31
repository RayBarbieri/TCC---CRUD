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
        Schema::create('itens_pedidos', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("quantidade");
            $table->decimal("valor", 10,2);
            $table->datetime("dt_item");

            $table->integer("produtos_id")->unsigned();
            $table->integer("pedidos_id")->unsigned();


            $table->foreign("produtos_id")
                ->references("id")
                ->on("produtos")->OnDelete("cascade");

            $table->foreign("pedidos_id")
                ->references("id")
                ->on("pedidos")->OnDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_pedidos');
    }
};
