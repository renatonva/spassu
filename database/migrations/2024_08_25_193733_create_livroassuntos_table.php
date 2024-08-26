<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livroassuntos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('livro_id')->index()->constrained('livros', 'id')->onDelete('cascade');
            $table->foreignUuid('assunto_id')->index()->constrained('assuntos', 'id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('livroassuntos');
    }
};
