<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const PREFIX ="category_";
    
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Horreur',
        'Comédie',
        'Fantastique',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (SELF::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference(self::PREFIX . $categoryName, $category);
        }

        $manager->flush();
    }
}
