<?php

namespace App\Factory;

use App\Entity\SOPTag;
use App\Repository\SOPTagRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static           SOPTag|Proxy findOrCreate(array $attributes)
 * @method static           SOPTag|Proxy random()
 * @method static           SOPTag[]|Proxy[] randomSet(int $number)
 * @method static           SOPTag[]|Proxy[] randomRange(int $min, int $max)
 * @method static           SOPTagRepository|RepositoryProxy repository()
 * @method SOPTag|Proxy     create($attributes = [])
 * @method SOPTag[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class SOPTagFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => rand(1, 10) > 5 ? self::faker()->sentence(1) : self::faker()->sentence(2),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(SOPTag $sOPTag) {})
        ;
    }

    protected static function getClass(): string
    {
        return SOPTag::class;
    }
}
