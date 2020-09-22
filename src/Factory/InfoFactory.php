<?php

namespace App\Factory;

use App\Entity\Info;
use App\Repository\InfoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static         Info|Proxy findOrCreate(array $attributes)
 * @method static         Info|Proxy random()
 * @method static         Info[]|Proxy[] randomSet(int $number)
 * @method static         Info[]|Proxy[] randomRange(int $min, int $max)
 * @method static         InfoRepository|RepositoryProxy repository()
 * @method Info|Proxy     create($attributes = [])
 * @method Info[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class InfoFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence,
            'text' => self::faker()->paragraph,
            'createdAt' => self::faker()->dateTimeBetween('-100 days', '-20 days'),
            'updatedAt' => self::faker()->dateTimeBetween('-20 days', '-1 days'),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Info $info) {})
        ;
    }

    protected static function getClass(): string
    {
        return Info::class;
    }
}
