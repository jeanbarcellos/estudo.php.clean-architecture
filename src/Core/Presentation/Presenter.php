<?php

namespace Core\Presentation;

use Core\Interfaces\Arrayable;
use Core\UseCase\OutputBoundary;
use DateTime;

class Presenter
{
    public function handle(OutputBoundary $output): array
    {
        if (empty($output->getValidationErrors())) {
            return $this->prepareSuccess($output);
        }

        return $this->prepareFailure($output);
    }

    private function prepareSuccess(OutputBoundary $output): array
    {
        $data = $output->toArray();

        $data['success'] = true;

        unset($data['validationErrors']);

        return [
            'success' => true,
            'data' => $this->recursive($data),
        ];
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

    private function prepareFailure(OutputBoundary $output): array
    {
        return [
            'success' => false,
            'errors' => $output->getValidationErrors(),
        ];
    }
}
