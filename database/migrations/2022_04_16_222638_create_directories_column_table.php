<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use App\Enums\Directory\Column\TypeEnum;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directories.columns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('entity_id')->unsigned();
            $table->bigInteger('relation_id')->unsigned()->nullable();
            $table->string('name',100);
            $table->string('symbol', 100);
            $table->enum('type', TypeEnum::LIST);
            $table->timestamps();

            $table->unique(['entity_id', 'name']);
            $table->unique(['entity_id', 'symbol']);

            $table->foreign('entity_id')
                ->references('id')
                ->on('directories.entities')
                ->onDelete('cascade');

            $table->foreign('relation_id')
                ->references('id')
                ->on('directories.columns')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directories.columns');
    }
};
