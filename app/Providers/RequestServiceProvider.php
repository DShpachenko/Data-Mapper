<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Http\Request;
use App\Http\Requests\AbstractRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

final class RequestServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->resolving(AbstractRequest::class, function ($request, $app): void {
            $this->initializeRequest($request, $app['request']);
        });

        $this->app->afterResolving(AbstractRequest::class, function (ValidatesWhenResolved $resolved): void {
            $resolved->validateResolved();
        });
    }

    protected function initializeRequest(AbstractRequest $form, Request $current): void
    {
        $form->initialize(
            $current->query->all(),
            $current->request->all(),
            $current->attributes->all(),
            [],
            [],
            $current->server->all(),
            $current->getContent()
        );

        $form->setContainer($this->app);
    }
}
