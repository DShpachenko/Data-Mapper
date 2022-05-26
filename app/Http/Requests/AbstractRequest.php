<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Dto\System\TokenPayloadDto;
use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

abstract class AbstractRequest extends Request implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;

    protected Container $container;

    protected string $errorBag = 'default';

    abstract public function rules(): array;

    abstract public function messages(): array;

    public function attributes(): array
    {
        return [];
    }

    public function setContainer(Container $container): self
    {
        $this->container = $container;

        return $this;
    }

    public function payload(): ?TokenPayloadDto
    {
        return TokenPayloadDto::fromArray($this->get('token_payload'));
    }

    protected function getValidatorInstance(): Validator
    {
        $factory = $this->container->make(ValidationFactory::class);

        $validator = method_exists($this, 'validator')
            ? $this->container->call([$this, 'validator'], compact('factory'))
            : $this->createDefaultValidator($factory);

        if (method_exists($this, 'withValidator')) {
            $this->withValidator($validator);
        }

        return $validator;
    }

    protected function createDefaultValidator(ValidationFactory $factory): Validator
    {
        return $factory->make(
            $this->validationData(),
            $this->container->call([$this, 'rules']),
            $this->messages(),
            $this->attributes()
        );
    }

    protected function validationData(): array
    {
        return $this->all();
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException($validator, $this->formatErrors($validator));
    }

    protected function formatErrors(Validator $validator): JsonResponse
    {
        return response()->__call('validation', [
            $validator->getMessageBag()->toArray(),
            Response::HTTP_BAD_REQUEST
        ]);
    }
}
