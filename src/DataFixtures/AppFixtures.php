<?php

namespace App\DataFixtures;

use App\Entity\CommentMarket;
use App\Entity\Day;
use App\Entity\Market;
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

        // Fixtures pour les 7 jours de la semaine

        $dayLundi = new Day();
        $dayLundi->setName('Lundi');
        $manager->persist($dayLundi);

        $dayMardi = new Day();
        $dayMardi->setName('Mardi');
        $manager->persist($dayMardi);

        $dayMercredi = new Day();
        $dayMercredi->setName('Mercredi');
        $manager->persist($dayMercredi);

        $dayJeudi = new Day();
        $dayJeudi->setName('Jeudi');
        $manager->persist($dayJeudi);

        $dayVendredi = new Day();
        $dayVendredi->setName('Vendredi');
        $manager->persist($dayVendredi);

        $daySamedi = new Day();
        $daySamedi->setName('Samedi');
        $manager->persist($daySamedi);

        $dayDimanche = new Day();
        $dayDimanche->setName('Dimanche');
        $manager->persist($dayDimanche);
        $manager->flush();

        // Fixtures pour des types

        $typeFruits = new Type();
        $typeFruits->setName('Fruits');
        $manager->persist($typeFruits);

        $typeLegumes = new Type();
        $typeLegumes->setName('Légumes');
        $manager->persist($typeLegumes);

        $typePoisson = new Type();
        $typePoisson->setName('Poisson');
        $manager->persist($typePoisson);

        $typeBoucher = new Type();
        $typeBoucher->setName('Boucher');
        $manager->persist($typeBoucher);

        $typeFromage = new Type();
        $typeFromage->setName('Fromage');
        $manager->persist($typeFromage);
        $manager->flush();

        // Fixtures pour des stands

        $standJeanne = new Stand();
        $standJeanne->setName('Stand de Jeanne');
        $standJeanne->addType($typeFruits);
        $standJeanne->addType($typePoisson);
        $manager->persist($standJeanne);

        $standGilbert = new Stand();
        $standGilbert->setName('Stand de Gilbert');
        $standGilbert->addType($typeFruits);
        $standGilbert->addType($typeLegumes);
        $manager->persist($standGilbert);

        $standjohn = new Stand();
        $standjohn->setName('Stand de John');
        $standjohn->addType($typeBoucher);
        $standjohn->addType($typeFromage);
        $manager->persist($standjohn);
        $manager->flush();

        // Fixtures commentaires

        $notice1 = new CommentMarket();
        $notice1->setNotice('Très très bien');
        $manager->persist($notice1);

        $notice2 = new CommentMarket();
        $notice2->setNotice('Pas bien');
        $manager->persist($notice2);

        $notice3 = new CommentMarket();
        $notice3->setNotice('Moyen');
        $manager->persist($notice3);

        $notice4 = new CommentMarket();
        $notice4->setNotice('Pas bon du tout');
        $manager->persist($notice4);

        $notice5 = new CommentMarket();
        $notice5->setNotice('Pas bon');
        $manager->persist($notice5);



        // Fixtures pour les 3 admins et 2 users

        $userJulien = new User();
        $userJulien->setEmail('hammerjulien67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('RougeXIII')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userJulien,'password123'));
        $userJulien->addCommentMarket($notice1);
        $manager->persist($userJulien);

        $userEmilie = new User();
        $userEmilie->setEmail('mimi67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('MimiDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userEmilie,'password123'));
        $userEmilie->addCommentMarket($notice2);
        $manager->persist($userEmilie);

        $userJohn = new User();
        $userJohn->setEmail('john67@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setAlias('JohnDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userJohn,'password123'));
        $userJohn->addCommentMarket($notice3);
        $manager->persist($userJohn);

        $userLucie = new User();
        $userLucie->setEmail('lucie67@gmail.com')
            ->setRoles(['ROLE_USER'])
            ->setAlias('LucieDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userLucie,'password123'));
        $userLucie->addCommentMarket($notice4);
        $manager->persist($userLucie);


        $userBetim = new User();
        $userBetim->setEmail('betim67@gmail.com')
            ->setRoles(['ROLE_ADMIN'])
            ->setAlias('BetimDu67')
            ->setRegion('Grand Est')
            ->setPassword($this->passwordEncoder->encodePassword($userBetim,'password123'));
        $userBetim->addCommentMarket($notice5);
        $manager->persist($userBetim);



        // Fixtures pour des marchés

        $market1 = new Market();
        $market1->setName('marché du neudorf')
            ->setTrack('Rue des champs')
            ->setPc('67000')
            ->setCity('Strasbourg')
            ->setRegion('Grand Est')
            ->setTimeFrom(8)
            ->setTimeTo(19);
        $market1->addCommentMarket($notice1);
        $market1->addDay($dayMercredi);
        $market1->addDay($daySamedi);
        $market1->addStand($standJeanne);
        $market1->addStand($standGilbert);
        $manager->persist($market1);

        $market2 = new Market();
        $market2->setName('marché du kléber')
            ->setTrack('Rue des bolets')
            ->setPc('67000')
            ->setCity('Strasbourg')
            ->setRegion('Grand Est')
            ->setTimeFrom(8)
            ->setTimeTo(19);
        $market2->addCommentMarket($notice2);
        $market2->addDay($dayVendredi);
        $market2->addDay($daySamedi);
        $market2->addStand($standGilbert);
        $market2->addStand($standjohn);
        $manager->persist($market2);

        $market3 = new Market();
        $market3->setName("marché du l'esplanade")
            ->setTrack('Rue des vents')
            ->setPc('67000')
            ->setCity('Strasbourg')
            ->setRegion('Grand Est')
            ->setTimeFrom(8)
            ->setTimeTo(19);
        $market3->addCommentMarket($notice3);
        $market3->addDay($dayLundi);
        $market3->addDay($dayMardi);
        $market3->addStand($standJeanne);
        $market3->addStand($standjohn);
        $manager->persist($market3);


        $market4 = new Market();
        $market4->setName('marché de la mairie de Haguenau')
            ->setTrack('Rue des champignons')
            ->setPc('67500')
            ->setCity('Haguenau')
            ->setRegion('Grand Est')
            ->setTimeFrom(8)
            ->setTimeTo(19);
        $market4->addCommentMarket($notice4);
        $market4->addDay($dayLundi);
        $market4->addDay($dayDimanche);
        $market4->addStand($standGilbert);
        $manager->persist($market4);

        $market5 = new Market();
        $market5->setName('marché magique')
            ->setTrack('Rue des bolets')
            ->setPc('67250')
            ->setCity('Saverne')
            ->setRegion('Grand Est')
            ->setTimeFrom(8)
            ->setTimeTo(19);
        $market5->addCommentMarket($notice5);
        $market5->addDay($dayJeudi);
        $market5->addDay($dayLundi);
        $market5->addStand($standjohn);
        $manager->persist($market5);

        $manager->flush();














    }
}
