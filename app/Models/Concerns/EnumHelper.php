<?php

declare(strict_types=1);

namespace App\Models\Concerns;

use BackedEnum;
use Illuminate\Support\Collection;

/**
 * Trait EnumHelper
 *
 * @package App\Models\Concerns
 * @mixin BackedEnum
 */
trait EnumHelper
{
    /**
     * @return array
     */
    public static function values(): array
    {
        return collect(self::cases())->map(fn($case) => $case->value)->toArray();
    }

    /**
     * @return Collection
     */
    public static function options(): Collection
    {
        $options = collect();
        foreach (self::cases() as $case) {
            $options->push([
                'id'   => $case->value,
                'text' => $case->text(),
            ]);
        }

        return $options;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'name'  => $this->name,
            'text'  => $this->text(),
        ];
    }

    /**
     * @return string
     */
    abstract protected function text(): string;
}
