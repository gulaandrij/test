<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class UserFixture
 *
 * @package App\DataFixtures
 */
class UserFixture extends Fixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $userManager = $this->container->get('fos_user.user_manager');

        /**
         * @var User $admin
         */
        $admin = $userManager->createUser();
        $admin->setUsername('admin');
        $admin->setEmail('admin@mail.com');
        $admin->setEnabled(true);
        $admin->setPlainPassword('passwd');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstName($faker->firstName);
        $admin->setLastName($faker->lastName);
        $admin->setBirthDay($faker->dateTime('-20years'));
        $userManager->updateUser($admin);

        $user = $userManager->createUser();
        $user->setUsername('user');
        $user->setEmail('user@mail.com');
        $user->setEnabled(true);
        $user->setPlainPassword('passwd');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName($faker->firstName);
        $user->setLastName($faker->lastName);
        $user->setBirthDay($faker->dateTime('-20years'));
        $userManager->updateUser($user);

        $this->setReference('user', $user);
    }
}
