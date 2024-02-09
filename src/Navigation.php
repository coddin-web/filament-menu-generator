<?php

declare(strict_types=1);

namespace CoddinWeb\FilamentMenuGenerator;

use Filament\Pages\Page;
use Filament\Resources\Resource;

abstract class Navigation
{
    /**
     * @param class-string<Resource|Page> $type
     */
    final public static function group(string $type): string
    {
        return \strval(__(static::getMenu()[$type]['group']));
    }

    /**
     * @param class-string<Resource|Page> $type
     */
    final public static function sort(string $type): int
    {
        $menuKeys = \array_keys(static::getMenu());
        $key = \array_search($type, $menuKeys, true);

        if (!\is_int($key)) {
            throw new \LogicException(
                \sprintf(
                    'The class %s is not in the menu order.',
                    $type,
                ),
            );
        }

        return ($key + 1);
    }

    /**
     * @return array<class-string<Resource|Page>, array{group: string}>
     */
    abstract public static function getMenu(): array;
}
