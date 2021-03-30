<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $faker =\Faker\Factory::create("fr_FR");

        for ($i=0;$i<100;$i++){
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setEmail($faker->email);
            $user->setDateCreated($faker->dateTimeBetween('-2 years'));
            $manager->persist($user);
        }

        $manager->flush();

        $users = $manager->getRepository(UserRepository::class)->findAll();
        $sexes = ['F','M','O'];
        foreach ($users as $user)
        {
            $profil = new Profil();
            $profil->setDescription($faker->text);
            $profil->setPostalCode($faker->postcode);
            $profil->getTown($faker->city);
            $profil->getBirthDate($faker->dateTimeBetween('-70 years','-18 years'));
            $profil->setSex($faker->randomElement($sexes));
            $profil->setDateCreated($faker->dateTimeBetween($user->getDateCreated()));
            $profil->setUser($faker->randomElement($users));

            $manager->persist($profil);
        }

        $manager->flush();

    }
}
