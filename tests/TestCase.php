<?php

declare(strict_types=1);

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

use Laravel\Lumen\Application;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    public function createApplication(): Application
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    protected function setUp(): void
    {
        parent::setUp();
        DB::beginTransaction();
    }

    protected function tearDown(): void
    {
        DB::rollback();
        parent::tearDown();
    }
}
