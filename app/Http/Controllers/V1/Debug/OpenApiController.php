<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Debug;

use Illuminate\Support\Facades\File;
use Laravel\Lumen\Routing\Controller;

final class OpenApiController extends Controller
{
    public function private(): string
    {
        return File::get(base_path(config('spec.private_open_api_file_path')));
    }

    public function public(): string
    {
        return File::get(base_path(config('spec.public_open_api_file_path')));
    }

    public function integration(): string
    {
        return File::get(base_path(config('spec.integration_open_api_file_path')));
    }
}
