<?php

namespace App\DataFixtures;

use App\Entity\Attraction;
use App\Entity\BannedWord;
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

        $bannedWords = ['putain','con','pute','pouffe','pouf','poufiase','pouffy','poufyase','pouffyase','cul','enculé','en cule','ntm','nique ta mère','enfoiré','pédé','pd','salot','mbdtc','fu','fuck','fucker','facka','maddafacka (<3)','bitch','biatch','motherfucker','fum','ass','asshole','fucking','fils de pute','fdp','bite','fuckoff','fuq','fuqa','pute','pouffe','pouf','poufiase','pouffy','poufyase','pouffyase','cul','enculé','en cule','ntm','nique ta mère','enfoiré','pédé','pd','salot','mbdtc','fu','fuck','fucker','facka','maddafacka (<3)','bitch','biatch','motherfucker','fum','ass','asshole','fucking','fils de pute','fdp','bite','fuckoff','fuq','fuqa'];

        foreach ($bannedWords as $bannedWord){
            $word = new BannedWord();
            $word->setWord($bannedWord);
            $manager->persist($word);
        }

        for ($i = 0; $i < 100; $i++) {
            $user = new User();
            $user->setUsername($faker->userName);
            $user->setPassword($faker->password);
            $user->setEmail($faker->email);
            $user->setDateCreated($faker->dateTimeBetween('-2 years'));
            $manager->persist($user);
        }

        $manager->flush();

        $users = $manager->getRepository(User::class)->findAll();
        $sexes = ['F', 'H', 'A'];
        foreach ($users as $user) {
            $profil = new Profil();
            $profil->setDescription($faker->text);
            $postCode = $faker->numberBetween(100,9599)*10;
            if ($postCode < 10000){
                $postCode = 0 . $postCode;
            }
            $profil->setPostalCode($postCode);
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
