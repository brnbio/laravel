<?php

declare(strict_types=1);

namespace App\Console\Commands\GenerateCommand;

use App\Support\Str;
use Exception;
use Throwable;

/**
 * Class ModelCreator
 * @package App\Console\Commands\GenerateCommand\Model
 */
class ModelCreator
{
    /**
     * @param string $name
     * @param string $tableName
     * @param array $attributes
     * @return string
     * @throws Throwable
     */
    public function create(string $name, string $tableName, array $attributes): string
    {
        $className = trim(class_basename($name));
        $content = view(
            'stubs.model',
            [
                'className'  => $className,
                'namespace'  => trim(str_replace('\\' . $className, '', $name)),
                'table'      => $tableName,
                'attributes' => $attributes,
            ]
        );

        $filename = app_path(str_replace('App' . DIRECTORY_SEPARATOR, '', str_replace('\\', DIRECTORY_SEPARATOR, $name)) . '.php');
        $targetDir = dirname($filename);
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (!file_put_contents($filename, $content->render())) {
            throw new Exception('Can\'t write model file!');
        }

        return $filename;
    }

    /**
     * @param array $attributes
     * @return string
     */
    private function createAttributes(array $attributes): string
    {
        $result = [];
        foreach ($attributes as $attribute) {
            $result[] = 'public const ATTRIBUTE_' . strtoupper($attribute['name']) . ' = "' . $attribute['name'] . '";';
        }

        return implode("\n    ", $result);
    }

    /**
     * @param array $attributes
     * @return string
     */
    private function createGetterSetter(array $attributes): string
    {
        $result = [];
        foreach ($attributes as $attribute) {
            $attributeName = Str::camel($attribute['name']);
            $result[] = Str::replace(
                [
                    'DummyReturnType'     => $attribute['type'],
                    'DummyAttributeUpper' => strtoupper($attributeName),
                    'DummyAttribute'      => ucfirst($attributeName),
                ],
                $this->getStub('getter')
            );
        }

        dd($result);

        return implode("\n    ", $result);
    }
}