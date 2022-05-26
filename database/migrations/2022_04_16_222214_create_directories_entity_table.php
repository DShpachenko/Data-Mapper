<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Enums\Directory\Entity\TypeEnum;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\Directory\Entity\VisibilityEnum;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('directories.entities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('parent_id')->unsigned()->nullable();
            $table->string('schema')->nullable();
            $table->string('name', 100)->unique();
            $table->string('symbol', 100)->unique();
            $table->enum('type', TypeEnum::LIST);
            $table->enum('visibility', VisibilityEnum::LIST)
                ->nullable()
                ->default(VisibilityEnum::PUBLIC);
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('directories.entities')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        DB::table('directories.entities')
            ->newQuery()
            ->from('directories.entities')
            ->where('type', TypeEnum::SCHEMA)
            ->get()
            ->map(function ($row) {
                DB::select('DROP SCHEMA ' . $row->symbol . ' CASCADE');
            });

        Schema::dropIfExists('directories.entities cascade');
    }
};
