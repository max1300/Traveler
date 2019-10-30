<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for($i= 0; $i < 10; $i++)
        {
            $user = new User();
            $user->setLogin($faker->userName)
                 ->setRoles(['ROLE_USER'])
                 ->setPassword($faker->password);

            
            $manager->persist($user);

        }

        $user = new User();
        $password = $this->passwordEncoder->encodePassword($user, 'pass_1234');
        $user->setLogin('Mouaz69')
             ->setRoles(['ROLE_ADMIN'])
             ->setPassword($password);
        $manager->persist($user);
        
        $manager->flush();
    }

}
