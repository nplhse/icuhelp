<?php

namespace App\Factory;

use App\Entity\SnippetCategory;
use App\Repository\SnippetCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static                    SnippetCategory|Proxy findOrCreate(array $attributes)
 * @method static                    SnippetCategory|Proxy random()
 * @method static                    SnippetCategory[]|Proxy[] randomSet(int $number)
 * @method static                    SnippetCategory[]|Proxy[] randomRange(int $min, int $max)
 * @method static                    SnippetCategoryRepository|RepositoryProxy repository()
 * @method SnippetCategory|Proxy     create($attributes = [])
 * @method SnippetCategory[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class SnippetCategoryFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence(rand(1, 3)),
            'priority' => self::faker()->numberBetween(1, 100),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(SnippetCategory $snippetCategory) {})
        ;
    }

    protected static function getClass(): string
    {
        return SnippetCategory::class;
    }
}
