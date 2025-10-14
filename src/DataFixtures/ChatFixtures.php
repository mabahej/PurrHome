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
            [
                'nom' => 'Minou',
                'age' => 3,
                'race' => 'Européen',
                'sexe' => 'M',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_PARIS,
                'reference' => self::CHAT_MINOU
            ],
            [
                'nom' => 'Felix',
                'age' => 5,
                'race' => 'Siamois',
                'sexe' => 'M',
                'etat_sante' => 'Excellent',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_PARIS,
                'reference' => self::CHAT_FELIX
            ],
            [
                'nom' => 'Luna',
                'age' => 2,
                'race' => 'Persan',
                'sexe' => 'F',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_PARIS,
                'reference' => self::CHAT_LUNA
            ],
            [
                'nom' => 'Tigrou',
                'age' => 4,
                'race' => 'Maine Coon',
                'sexe' => 'M',
                'etat_sante' => 'Traitement en cours',
                'statut' => 'En observation',
                'refuge' => RefugeFixtures::REFUGE_LYON,
                'reference' => self::CHAT_TIGROU
            ],
            [
                'nom' => 'Nala',
                'age' => 1,
                'race' => 'Bengal',
                'sexe' => 'F',
                'etat_sante' => 'Excellente',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_LYON,
                'reference' => self::CHAT_NALA
            ],
            [
                'nom' => 'Simba',
                'age' => 6,
                'race' => 'Chartreux',
                'sexe' => 'M',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Réservé',
                'refuge' => RefugeFixtures::REFUGE_LYON,
                'reference' => self::CHAT_SIMBA
            ],
            [
                'nom' => 'Minette',
                'age' => 7,
                'race' => 'Européen',
                'sexe' => 'F',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_MARSEILLE,
                'reference' => self::CHAT_MINETTE
            ],
            [
                'nom' => 'Oscar',
                'age' => 3,
                'race' => 'British Shorthair',
                'sexe' => 'M',
                'etat_sante' => 'Excellent',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_MARSEILLE,
                'reference' => self::CHAT_OSCAR
            ],
            [
                'nom' => 'Bella',
                'age' => 2,
                'race' => 'Ragdoll',
                'sexe' => 'F',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_MARSEILLE,
                'reference' => self::CHAT_BELLA
            ],
            [
                'nom' => 'Max',
                'age' => 4,
                'race' => 'Sacré de Birmanie',
                'sexe' => 'M',
                'etat_sante' => 'Excellent',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_TOULOUSE,
                'reference' => self::CHAT_MAX
            ],
            [
                'nom' => 'Cleo',
                'age' => 5,
                'race' => 'Sphynx',
                'sexe' => 'F',
                'etat_sante' => 'Bonne santé',
                'statut' => 'Adopté',
                'refuge' => RefugeFixtures::REFUGE_TOULOUSE,
                'reference' => self::CHAT_CLEO
            ],
            [
                'nom' => 'Charlie',
                'age' => 1,
                'race' => 'Européen',
                'sexe' => 'M',
                'etat_sante' => 'Excellente',
                'statut' => 'Disponible',
                'refuge' => RefugeFixtures::REFUGE_TOULOUSE,
                'reference' => self::CHAT_CHARLIE
            ],
        ];

        foreach ($chatsData as $data) {
            $chat = new Chat();
            $chat->setNom($data['nom']);
            $chat->setAge($data['age']);
            $chat->setRace($data['race']);
            $chat->setSexe($data['sexe']);
            $chat->setEtatSante($data['etat_sante']);
            $chat->setStatut($data['statut']);
            $chat->setIdRefuge($this->getReference($data['refuge'],Refuge::class));
            $manager->persist($chat);
            $this->addReference($data['reference'], $chat);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            RefugeFixtures::class,
        ];
    }
}