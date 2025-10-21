<?php

namespace App\DataFixtures;

use App\Entity\Refuge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RefugeFixtures extends Fixture
{
    public const REFUGE_PARIS = 'refuge-paris';
    public const REFUGE_LYON = 'refuge-lyon';
    public const REFUGE_MARSEILLE = 'refuge-marseille';
    public const REFUGE_TOULOUSE = 'refuge-toulouse';
    
    public function load(ObjectManager $manager): void
    {
        $refuge1 = new Refuge();
        $refuge1->setNom('Refuge des Chats Heureux');
        $refuge1->setLocalisation('Paris, 75015');
        $refuge1->setContact('01 23 45 67 89');
        $manager->persist($refuge1);
        $this->addReference(self::REFUGE_PARIS, $refuge1);
        
        $refuge2 = new Refuge();
        $refuge2->setNom('Association Féline de Lyon');
        $refuge2->setLocalisation('Lyon, 69003');
        $refuge2->setContact('04 78 90 12 34');
        $manager->persist($refuge2);
        $this->addReference(self::REFUGE_LYON, $refuge2);
        
        $refuge3 = new Refuge();
        $refuge3->setNom('SOS Chats Marseille');
        $refuge3->setLocalisation('Marseille, 13008');
        $refuge3->setContact('04 91 23 45 67');
        $manager->persist($refuge3);
        $this->addReference(self::REFUGE_MARSEILLE, $refuge3);
        
        $refuge4 = new Refuge();
        $refuge4->setNom('Les Amis des Chats');
        $refuge4->setLocalisation('Toulouse, 31000');
        $refuge4->setContact('05 61 12 34 56');
        $manager->persist($refuge4);
        $this->addReference(self::REFUGE_TOULOUSE, $refuge4);
        
        $manager->flush();
    }
}
