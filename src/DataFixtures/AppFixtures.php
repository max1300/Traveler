<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Pays;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $lines = file('public\sql-pays.csv');

        foreach ($lines as $line_num =>$line) {
            $pays = new Pays();
            $pays->setNom($line);
            $manager->persist($pays); 
        }
        
        $manager->flush();
    }
}
