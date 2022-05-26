<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directories.relations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('from_entity_id')->unsigned();
            $table->bigInteger('to_entity_id')->unsigned();
            $table->bigInteger('from_column_id')->unsigned();
            $table->bigInteger('to_column_id')->unsigned();
            $table->string('foreign',200);
            $table->string('references', 200);
            $table->string('table', 200);
            $table->timestamps();

            $table->unique(['from_entity_id', 'to_entity_id', 'foreign']);

            $table->foreign('from_entity_id')
                ->references('id')
                ->on('directories.entities')
                ->onDelete('cascade');

            $table->foreign('to_entity_id')
                ->references('id')
                ->on('directories.entities')
                ->onDelete('cascade');

            $table->foreign('from_column_id')->references('id')->on('directories.columns');
            $table->foreign('to_column_id')->references('id')->on('directories.columns');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directories.relations');
    }
};
