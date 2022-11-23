<?php

namespace App\DataFixtures;


use App\Entity\Season;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASON_PER_PROGRAM = 5;
    public const PREFIX = "season_";
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();
        //Je boucle sur le nombre de programmes
        for ($i = 0; $i < ProgramFixtures::TOTAL_FIXTURES; $i++) {
            //Je récupère la reference a un program pour l'utiliser dans setProgram
            $program = $this->getReference(ProgramFixtures::PREFIX . $i);

            // Je boucle sur ma constante  SEASON_PER_PROGRAM
            for ($j = 0; $j < self::SEASON_PER_PROGRAM; $j++) {
                $season = new Season();
                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                $season->setNumber($j + 1);
                $season->setYear($faker->year());
                $season->setDescription($faker->paragraphs(3, true));
                $season->setProgram($program);
                //J'utilise la reference a program recupérée plus haut
                $manager->persist($season);
                $this->addReference(ProgramFixtures::PREFIX . $i . '_' . self::PREFIX . $j, $season);
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
