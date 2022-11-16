<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        [
            'name' => 'The Wilders',
            'title' => 'The Wilders',
            'synopsis' => 'Ils sont de retour',
            'poster' => 'wilders.jpg',
            'category' => 'Action',
        ],
        [
            'name' => 'Noé',
            'title' => 'Noé',
            'synopsis' => 'Ils ne vont jamais s\'arreter',
            'poster' => 'noe.jpg',
            'category' => 'Aventure',

        ],
        [
            'name' => 'Les rebus',
            'title' => 'Les rebus',
            'synopsis' => 'Ils ne lacherons rien',
            'poster' => 'rebus.jpg',
            'category' => 'Comédie',

        ],
        [
            'name' => 'The Crown',
            'title' => 'The Crown',
            'synopsis' => 'Ils sont là et il était temps',
            'poster' => 'crown.jpg',
            'category' => 'Fantastique',

        ],
        [
            'name' => 'Jurassic Park',
            'title' => 'Jurassic Park',
            'synopsis' => 'L\'armée approche',
            'poster' => 'jurassic',
            'category' => 'Horreur',

        ]

    ];
    public function load(ObjectManager $manager): void
    {

        foreach (SELF::PROGRAMS as $key => $serie) {
            $program = new Program();
            $program->setName($serie['name']);
            $program->setTitle($serie['title']);
            $program->setSynopsis($serie['synopsis']);
            $program->setPoster($serie['poster']);
            $program->setCategory($this->getReference('category_' . $serie['category']));
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
