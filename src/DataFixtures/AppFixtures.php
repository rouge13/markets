<?php

namespace App\DataFixtures;

use App\Entity\Day;
use App\Entity\Stand;
use App\Entity\Type;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
class AppFixtures extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }


    public function load(ObjectManager $manager)
    {
//        fixtures pour 3 admin + table day + stand+ type

        // Fixtures pour les 3 admins

        $userJulien = new User();
        $userJulien->setEmail('hammerjulien67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('RougeXIII')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userJulien,'password123'));
        $manager->persist($userJulien);
        $manager->flush();

        $userEmilie = new User();
        $userEmilie->setEmail('mimi67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('MimiDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userEmilie,'password123'));
        $manager->persist($userEmilie);
        $manager->flush();

        $userBetim = new User();
        $userBetim->setEmail('betim67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('BetimDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userBetim,'password123'));
        $manager->persist($userBetim);
        $manager->flush();


        // Fixtures pour les 7 jours de la semaine

        $dayLundi = new Day();
        $dayLundi->setName('Lundi');
        $manager->persist($dayLundi);
        $manager->flush();

        $dayMardi = new Day();
        $dayMardi->setName('Mardi');
        $manager->persist($dayMardi);
        $manager->flush();

        $dayMercredi = new Day();
        $dayMercredi->setName('Mercredi');
        $manager->persist($dayMercredi);
        $manager->flush();

        $dayJeudi = new Day();
        $dayJeudi->setName('Jeudi');
        $manager->persist($dayJeudi);
        $manager->flush();

        $dayVendredi = new Day();
        $dayVendredi->setName('Vendredi');
        $manager->persist($dayVendredi);
        $manager->flush();

        $daySamedi = new Day();
        $daySamedi->setName('Samedi');
        $manager->persist($daySamedi);
        $manager->flush();

        $dayDimanche = new Day();
        $dayDimanche->setName('Dimanche');
        $manager->persist($dayDimanche);
        $manager->flush();


        // Fixtures pour des stands



        $standJeanne = new Stand();
        $standJeanne->setName('Stand de Jeanne');
        $standJeanne->addType($this->getReference($typeFruits));
        $manager->persist($standJeanne);
        $manager->flush();

        $standGilbert = new Stand();
        $standGilbert->setName('Stand de Gilbert');
        $manager->persist($standGilbert);
        $manager->flush();

        $standjohn = new Stand();
        $standjohn->setName('Stand de John');
        $manager->persist($standjohn);
        $manager->flush();


        // Fixtures pour des types

        $typeFruits = new Type();
        $manager->persist($typeFruits);
        $manager->flush();

        $typeLegumes = new Type();
        $typeLegumes->setName('Légumes');
        $manager->persist($typeLegumes);
        $manager->flush();

        $typePoisson = new Type();
        $typePoisson->setName('Poisson');
        $manager->persist($typePoisson);
        $manager->flush();

        $typeBoucher = new Type();
        $typeBoucher->setName('Boucher');
        $manager->persist($typeBoucher);
        $manager->flush();

        $typeFromage = new Type();
        $typeFromage->setName('Fromage');
        $manager->persist($typeFromage);
        $manager->flush();


    }
}
