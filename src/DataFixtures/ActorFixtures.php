<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public const TOTAL_ACTORS = 10;
    public const PREFIX = 'actor_';
    public const PROGRAM_PER_ACTOR = 3;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < self::TOTAL_ACTORS; $i++) {
            $actor = new Actor;
            $actor->setFirstname($faker->firstName());
            $actor->setLastname($faker->lastName());
            $actor->setBirthDate($faker->dateTimeThisCentury());
            
            for ($j = 0; $j < self::PROGRAM_PER_ACTOR; $j++) {               
                $program = $this->getReference(ProgramFixtures::PREFIX . ($j + 1));
                $actor->addProgram($program);
            }

            $manager->persist($actor);
            $this->addReference(self::PREFIX. $i, $actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
            CategoryFixtures::class
        ];
    }
}
