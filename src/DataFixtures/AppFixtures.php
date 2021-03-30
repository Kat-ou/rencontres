<?php

namespace App\DataFixtures;

use App\Entity\Attraction;
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

        $faker = \Faker\Factory::create("fr_FR");

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setEmail($faker->email);
            $user->setDateCreated($faker->dateTimeBetween('-2 years'));
            $manager->persist($user);
        }

        $manager->flush();

        $users = $manager->getRepository(UserRepository::class)->findAll();
        $sexes = ['F', 'M', 'O'];
        foreach ($users as $user) {
            $profil = new Profil();
            $profil->setDescription($faker->text);
            $profil->setPostalCode($faker->postcode);
            $profil->setTown($faker->city);
            $profil->setBirthDate($faker->dateTimeBetween('-70 years', '-18 years'));
            $profil->setSex($faker->randomElement($sexes));
            $profil->setDateCreated($faker->dateTimeBetween($user->getDateCreated()));
            $profil->setUser($faker->randomElement($users));

            $manager->persist($profil);
        }
        for ($i = 0; $i < 1000; $i++) {
            $attraction = new Attraction();
            $user1 = $faker->randomElement($users);
            $attraction->setUser1($user1);

            do {
                $user2 = $faker->randomElement($users);
            } while ($user2 == $user1);
            $attraction->setUser2($user2);
            $attraction->setDateCreated($faker->dateTimeBetween($user->getDateCreated()));
            $attraction->setIsOkUser1($faker->boolean);
            $attraction->setIsOkUser2($faker->boolean);

            if($attraction->getIsOkUser1() == $attraction->getIsOkUser2()){
                $attraction->getIsMatch(true);
            }else{
                $attraction->getIsMatch(false);
            }
            $manager->persist($attraction);
        }


        $manager->flush();

    }
}
