<?php

namespace App\Factory;

use App\Entity\Snippet;
use App\Repository\SnippetRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Snippet|Proxy findOrCreate(array $attributes)
 * @method static Snippet|Proxy random()
 * @method static Snippet[]|Proxy[] randomSet(int $number)
 * @method static Snippet[]|Proxy[] randomRange(int $min, int $max)
 * @method static SnippetRepository|RepositoryProxy repository()
 * @method Snippet|Proxy create($attributes = [])
 * @method Snippet[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class SnippetFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence(rand(1, 3)),
            'text' => self::faker()->paragraph,
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Snippet $snippet) {})
        ;
    }

    protected static function getClass(): string
    {
        return Snippet::class;
    }
}
