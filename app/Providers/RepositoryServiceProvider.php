<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

final class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $repositories = config('repositories');

        foreach ($repositories as $repository) {
            if (isset($repository['cache'])) {
                $this->app->bind($repository['interface'], $repository['cache']);
                $this->app
                    ->when($repository['cache'])
                    ->needs($repository['interface'])
                    ->give($repository['implementation']);
            } else {
                $this->app->bind($repository['interface'], $repository['implementation']);
            }
        }
    }
}
