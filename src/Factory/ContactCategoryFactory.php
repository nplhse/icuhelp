<?php

namespace App\Factory;

use App\Entity\ContactCategory;
use App\Repository\ContactCategoryRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static                    ContactCategory|Proxy findOrCreate(array $attributes)
 * @method static                    ContactCategory|Proxy random()
 * @method static                    ContactCategory[]|Proxy[] randomSet(int $number)
 * @method static                    ContactCategory[]|Proxy[] randomRange(int $min, int $max)
 * @method static                    ContactCategoryRepository|RepositoryProxy repository()
 * @method ContactCategory|Proxy     create($attributes = [])
 * @method ContactCategory[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class ContactCategoryFactory extends ModelFactory
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
            // ->beforeInstantiate(function(ContactCategory $contactCategory) {})
        ;
    }

    protected static function getClass(): string
    {
        return ContactCategory::class;
    }
}
