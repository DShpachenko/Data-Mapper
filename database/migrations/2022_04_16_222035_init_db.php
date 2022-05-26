<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

final class InitDb extends Migration
{
    public function up(): void
    {
        DB::select('CREATE SCHEMA directories');
    }

    public function down(): void
    {
        DB::select('DROP SCHEMA directories CASCADE');
    }
}
