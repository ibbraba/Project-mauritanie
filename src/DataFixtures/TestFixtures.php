<?php




namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername("usernametest")
            ->setPassword("passwordtest")
            ->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();

    }

}