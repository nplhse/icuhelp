<?php

namespace App\Factory;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static            Contact|Proxy findOrCreate(array $attributes)
 * @method static            Contact|Proxy random()
 * @method static            Contact[]|Proxy[] randomSet(int $number)
 * @method static            Contact[]|Proxy[] randomRange(int $min, int $max)
 * @method static            ContactRepository|RepositoryProxy repository()
 * @method Contact|Proxy     create($attributes = [])
 * @method Contact[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class ContactFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => rand(1, 10) > 5 ? self::faker()->company : self::faker()->name,
            'phone' => rand(1, 10) > 2 ? self::faker()->phoneNumber : '',
            'fax' => rand(1, 10) > 8 ? self::faker()->phoneNumber : '',
            'email' => rand(1, 10) > 6 ? self::faker()->safeEmail : '',
            'address' => rand(1, 10) > 6 ? self::faker()->address : '',
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Contact $contact) {})
        ;
    }

    protected static function getClass(): string
    {
        return Contact::class;
    }
}
