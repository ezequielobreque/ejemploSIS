<?php
/**
 * Created by PhpStorm.
 * User: ezequiel_o
 * Date: 10/5/2019
 * Time: 8:48 PM
 */

namespace AppBundle\DataFixtures;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\User;

class LoadUserData Extends AbstractFixture implements OrderedFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $EzequielO =new User();
        $EzequielO ->setUsername('Ezequiel');
        $EzequielO ->setPassword('test');
        $EzequielO ->setEmail('ezequiel@gmail.com');
        $manager->persist($EzequielO);


        $this->addReference('EzequielO',$EzequielO);

        $FacuT =new User();
        $FacuT ->setUsername('Facu');
        $FacuT ->setPassword('test');
        $FacuT ->setEmail('facu@gmail.com');
        $manager->persist($FacuT);


        $this->addReference('FacuT',$FacuT);

        $AbrilM =new User();
        $AbrilM ->setUsername('Abril');
        $AbrilM ->setPassword('test');
        $AbrilM ->setEmail('abril@gmail.com');
        $manager->persist($AbrilM);


        $this->addReference('AbrilM',$AbrilM);

        $SantiagoA =new User();
        $SantiagoA ->setUsername('Santiago');
        $SantiagoA ->setPassword('test');
        $SantiagoA ->setEmail('santiago@gmail.com');
        $manager->persist($SantiagoA);


        $this->addReference('SantiagoA',$SantiagoA);
        $manager->persist($EzequielO,$FacuT,$AbrilM,$SantiagoA);
        $manager->flush();
    }
    public function getOrder()
    {
      return 1;  // TODO: Implement getOrder() method.
    }


}