<?php

namespace Core\Presentation;

use Core\Interfaces\Arrayable;
use Core\UseCase\OutputBoundary;
use DateTime;
use Framework\Http\JsonResponse;
use Framework\Http\ResponseInterface;

class Presenter
{
    public function handle(OutputBoundary $output): ResponseInterface
    {
        if (empty($output->getValidationErrors())) {
            return $this->prepareSuccess($output);
        }

        return $this->prepareFailure($output);
    }

    private function prepareSuccess(OutputBoundary $output): ResponseInterface
    {
        $data = $output->toArray();

        $data['success'] = true;

        unset($data['validationErrors']);

        return new JsonResponse($this->recursive($data), 200);
    }

    private function recursive(array $data): array
    {
        $output = [];

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $output[$key] = $this->recursive($value);
                continue;
            }

            if ($value instanceof Arrayable) {
                $output[$key] = $this->recursive($value->toArray());
                continue;
            }

            $output[$key] = $this->prepareValue($value);
        }

        return $output;
    }

    private function prepareValue($value)
    {
        if ($value instanceof DateTime) {
            return $value->format(DateTime::ISO8601);
        }

        return $value;
    }

    private function prepareFailure(OutputBoundary $output): ResponseInterface
    {
        return new JsonResponse([
            'message' => 'Error',
            'errors' => $output->getValidationErrors(),
        ], 400);
    }
}
