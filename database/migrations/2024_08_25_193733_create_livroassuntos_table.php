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
            $table->foreignUuid('livro_cod')->index()->constrained('livros', 'cod')->onDelete('cascade');
            $table->foreignUuid('assunto_codas')->index()->constrained('assuntos', 'codAs')->onDelete('cascade');
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
