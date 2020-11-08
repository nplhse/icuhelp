<?php

namespace App\Factory;

use App\Entity\SOP;
use App\Repository\SOPRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static        SOP|Proxy findOrCreate(array $attributes)
 * @method static        SOP|Proxy random()
 * @method static        SOP[]|Proxy[] randomSet(int $number)
 * @method static        SOP[]|Proxy[] randomRange(int $min, int $max)
 * @method static        SOPRepository|RepositoryProxy repository()
 * @method SOP|Proxy     create($attributes = [])
 * @method SOP[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class SOPFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence(rand(1, 3)),
            'description' => self::faker()->sentence(),
            'sopFilename' => self::faker()->file('assets/fixtures', 'public/files', false),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(SOP $sOP) {})
        ;
    }

    protected static function getClass(): string
    {
        return SOP::class;
    }
}
