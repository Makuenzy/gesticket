<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    
    private $encoder;
    
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    
  
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setLogin('admin');
        $user->setNom('admin');
        $user->setPrenom('admin');
        $user->setRoles(['ROLE_ASSISTANT_DIRECTION']);
        $password = $this->encoder->encodePassword($user, 'passer');
        $user->setPassword($password);
    
        $manager->persist($user);
        $manager->flush();
    }
}
