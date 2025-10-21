<?php

namespace App\DataFixtures;

use App\Entity\Chat;
use App\Entity\Refuge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChatFixtures extends Fixture implements DependentFixtureInterface
{
    public const CHAT_MINOU = 'chat-minou';
    public const CHAT_FELIX = 'chat-felix';
    public const CHAT_LUNA = 'chat-luna';
    public const CHAT_TIGROU = 'chat-tigrou';
    public const CHAT_NALA = 'chat-nala';
    public const CHAT_SIMBA = 'chat-simba';
    public const CHAT_MINETTE = 'chat-minette';
    public const CHAT_OSCAR = 'chat-oscar';
    public const CHAT_BELLA = 'chat-bella';
    public const CHAT_MAX = 'chat-max';
    public const CHAT_CLEO = 'chat-cleo';
    public const CHAT_CHARLIE = 'chat-charlie';
    
    public function load(ObjectManager $manager): void
    {
        $chatsData = [
            ['nom'=>'Minou','age'=>3,'race'=>'Européen','sexe'=>'M','etatSante'=>'Bonne santé','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_PARIS,'ref'=>self::CHAT_MINOU],
            ['nom'=>'Felix','age'=>5,'race'=>'Siamois','sexe'=>'M','etatSante'=>'Excellent','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_PARIS,'ref'=>self::CHAT_FELIX],
            ['nom'=>'Luna','age'=>2,'race'=>'Persan','sexe'=>'F','etatSante'=>'Bonne santé','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_PARIS,'ref'=>self::CHAT_LUNA],
            ['nom'=>'Tigrou','age'=>4,'race'=>'Maine Coon','sexe'=>'M','etatSante'=>'Traitement en cours','statut'=>'En observation','refuge'=>RefugeFixtures::REFUGE_LYON,'ref'=>self::CHAT_TIGROU],
            ['nom'=>'Nala','age'=>1,'race'=>'Bengal','sexe'=>'F','etatSante'=>'Excellente','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_LYON,'ref'=>self::CHAT_NALA],
            ['nom'=>'Simba','age'=>6,'race'=>'Chartreux','sexe'=>'M','etatSante'=>'Bonne santé','statut'=>'Réservé','refuge'=>RefugeFixtures::REFUGE_LYON,'ref'=>self::CHAT_SIMBA],
            ['nom'=>'Minette','age'=>7,'race'=>'Européen','sexe'=>'F','etatSante'=>'Bonne santé','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_MARSEILLE,'ref'=>self::CHAT_MINETTE],
            ['nom'=>'Oscar','age'=>3,'race'=>'British Shorthair','sexe'=>'M','etatSante'=>'Excellent','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_MARSEILLE,'ref'=>self::CHAT_OSCAR],
            ['nom'=>'Bella','age'=>2,'race'=>'Ragdoll','sexe'=>'F','etatSante'=>'Bonne santé','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_MARSEILLE,'ref'=>self::CHAT_BELLA],
            ['nom'=>'Max','age'=>4,'race'=>'Sacré de Birmanie','sexe'=>'M','etatSante'=>'Excellent','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_TOULOUSE,'ref'=>self::CHAT_MAX],
            ['nom'=>'Cleo','age'=>5,'race'=>'Sphynx','sexe'=>'F','etatSante'=>'Bonne santé','statut'=>'Adopté','refuge'=>RefugeFixtures::REFUGE_TOULOUSE,'ref'=>self::CHAT_CLEO],
            ['nom'=>'Charlie','age'=>1,'race'=>'Européen','sexe'=>'M','etatSante'=>'Excellente','statut'=>'Disponible','refuge'=>RefugeFixtures::REFUGE_TOULOUSE,'ref'=>self::CHAT_CHARLIE],
        ];
        
        foreach ($chatsData as $data) {
            $chat = new Chat();
            $chat->setNom($data['nom']);
            $chat->setAge($data['age']);
            $chat->setRace($data['race']);
            $chat->setSexe($data['sexe']);
            $chat->setEtatSante($data['etatSante']);
            $chat->setStatut($data['statut']);
            $chat->setIdRefuge($this->getReference($data['refuge'], Refuge::class));
            $manager->persist($chat);
            $this->addReference($data['ref'], $chat);
        }
        
        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return [RefugeFixtures::class];
    }
}
