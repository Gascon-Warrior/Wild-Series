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
            'year' => 2000,
            'synopsis' => 'Ils sont de retour',
            'poster' => 'wilders.jpg',
            'category' => 'Action',
            'country' => 'France',
        ],
        [
            'name' => 'Noé',
            'title' => 'Noé',
            'year' => 2000,
            'synopsis' => 'Ils ne vont jamais s\'arreter',
            'poster' => 'noe.jpg',
            'category' => 'Aventure',
            'country' => 'France',

        ],
        [
            'name' => 'Les rebus',
            'title' => 'Les rebus',
            'year' => 2000,
            'synopsis' => 'Ils ne lacherons rien',
            'poster' => 'rebus.jpg',
            'category' => 'Comédie',
            'country' => 'France',


        ],
        [
            'name' => 'The Crown',
            'title' => 'The Crown',
            'year' => 2000,
            'synopsis' => 'Ils sont là et il était temps',
            'poster' => 'crown.jpg',
            'category' => 'Fantastique',
            'country' => 'France',


        ],
        [
            'name' => 'Jurassic Park',
            'title' => 'Jurassic Park',
            'year' => 2000,
            'synopsis' => 'L\'armée approche',
            'poster' => 'jurassic',
            'category' => 'Horreur',
            'country' => 'France',


        ]

    ];
    public function load(ObjectManager $manager): void
    {

        foreach (SELF::PROGRAMS as $key => $serie) {
            $program = new Program();
            $program->setName($serie['name']);
            $program->setTitle($serie['title']);
            $program->setYear($serie['year']);
            $program->setSynopsis($serie['synopsis']);
            $program->setPoster($serie['poster']);
            $program->setCategory($this->getReference('category_' . $serie['category']));
            $program->setCountry($serie['country']);

            $manager->persist($program);
            $this->addReference('program_' . $serie['title'], $program);
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
