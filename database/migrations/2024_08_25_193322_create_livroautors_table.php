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
        Schema::create('livroautor', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('livro_cod')->index()->constrained('livros', 'cod')->onDelete('cascade');
            $table->foreignUuid('auto_codau')->index()->constrained('autor', 'codAu')->onDelete('cascade');
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
        Schema::dropIfExists('livroautor');
    }
};
