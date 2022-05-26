<?php

declare(strict_types=1);

namespace App\Console\Commands\Debug\Spec;

use Illuminate\Console\Command;
use App\Services\OpenApi\BundlerService;

final class OpenApiBuild extends Command
{
    protected $signature = 'openapi-build';

    protected $description = 'Собирает итоговые файлы доки из исходников в папке spec/ в формате .yaml';

    public function handle(BundlerService $bundlerService): void
    {
        $fileName = $bundlerService->build(
            BundlerService::VERSION_V1,
            BundlerService::PRIVATE_REALMS,
            BundlerService::TYPE_DEV
        );

        $this->info('Well Done! Итоговый файл документации ' . $fileName . ' успешно собран!');

        $fileName = $bundlerService->build(
            BundlerService::VERSION_V1,
            BundlerService::PUBLIC_REALMS,
            BundlerService::TYPE_DEV
        );

        $this->info('Well Done! Итоговый файл документации ' . $fileName . ' успешно собран!');

        $fileName = $bundlerService->build(
            BundlerService::VERSION_V1,
            BundlerService::INTEGRATION_REALMS,
            BundlerService::TYPE_DEV
        );

        $this->info('Well Done! Итоговый файл документации ' . $fileName . ' успешно собран!');
    }
}
