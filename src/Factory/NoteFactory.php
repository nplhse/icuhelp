<?php

namespace App\Factory;

use App\Entity\Note;
use App\Repository\NoteRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Note|Proxy findOrCreate(array $attributes)
 * @method static Note|Proxy random()
 * @method static Note[]|Proxy[] randomSet(int $number)
 * @method static Note[]|Proxy[] randomRange(int $min, int $max)
 * @method static NoteRepository|RepositoryProxy repository()
 * @method Note|Proxy create($attributes = [])
 * @method Note[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class NoteFactory extends ModelFactory
{
    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->sentence,
            'text' => self::faker()->paragraph,
            'category' => 'note',
            'createdAt' => self::faker()->dateTimeBetween('-100 days', '-20 days'),
            'updatedAt' => self::faker()->dateTimeBetween('-20 days', '-1 days'),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->beforeInstantiate(function(Note $note) {})
        ;
    }

    protected static function getClass(): string
    {
        return Note::class;
    }

    public function asOnboarding(): self
    {
        return $this->addState(['category' => 'onboarding']);
    }
}
