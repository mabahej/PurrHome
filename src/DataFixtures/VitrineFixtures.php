<?php

namespace App\DataFixtures;

use App\Entity\Vitrine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Member;
use App\Entity\Chat;

class VitrineFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $vitrinesData = [
            [
                'photo_url' => 'https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba',
                'description' => 'Minou est un chat adorable et affectueux qui cherche une famille aimante.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_PARIS,
                'chats' => [ChatFixtures::CHAT_MINOU]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1573865526739-10c1dd7be1fb',
                'description' => 'Felix est un magnifique Siamois très sociable.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_PARIS,
                'chats' => [ChatFixtures::CHAT_FELIX]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1529778873920-4da4926a72c2',
                'description' => 'Luna, une persane élégante au caractère doux.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_PARIS,
                'chats' => [ChatFixtures::CHAT_LUNA]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1574158622682-e40e69881006',
                'description' => 'Tigrou se remet d\'une petite maladie mais sera bientôt prêt pour l\'adoption.',
                'publiee' => false,
                'createur' => MemberFixtures::MEMBER_LYON,
                'chats' => [ChatFixtures::CHAT_TIGROU]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1543852786-1cf6624b9987',
                'description' => 'Nala est une jeune Bengal pleine d\'énergie et de joie de vivre.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_LYON,
                'chats' => [ChatFixtures::CHAT_NALA]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1517331156700-3c241d2b4d83',
                'description' => 'Simba, un Chartreux majestueux déjà réservé par une famille.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_LYON,
                'chats' => [ChatFixtures::CHAT_SIMBA]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1570458436416-b8fcccfe883e',
                'description' => 'Minette cherche un foyer calme pour ses vieux jours.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_MARSEILLE,
                'chats' => [ChatFixtures::CHAT_MINETTE]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1526336024174-e58f5cdd8e13',
                'description' => 'Oscar et Bella, deux amis inséparables à adopter ensemble!',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_MARSEILLE,
                'chats' => [ChatFixtures::CHAT_OSCAR, ChatFixtures::CHAT_BELLA]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1548247416-ec66f4900b2e',
                'description' => 'Max, un Sacré de Birmanie au regard envoûtant.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_TOULOUSE,
                'chats' => [ChatFixtures::CHAT_MAX]
            ],
            [
                'photo_url' => 'https://images.unsplash.com/photo-1519052537078-e6302a4968d4',
                'description' => 'Charlie, un chaton joueur qui adore les câlins.',
                'publiee' => true,
                'createur' => MemberFixtures::MEMBER_TOULOUSE,
                'chats' => [ChatFixtures::CHAT_CHARLIE]
            ],
        ];
        
        foreach ($vitrinesData as $data) {
            $vitrine = new Vitrine();
            $vitrine->setPhotoUrl($data['photo_url']);
            $vitrine->setDescription($data['description']);
            $vitrine->setPubliee($data['publiee']);
            $vitrine->setCreateur($this->getReference($data['createur'],Member::class));
            
            // Add the first chat as the main chat (ManyToOne)
            $firstChat = $this->getReference($data['chats'][0],Chat::class);
            $vitrine->setChat($firstChat);
            
            // Add all chats to the ManyToMany relationship
            foreach ($data['chats'] as $chatRef) {
                $vitrine->addChat($this->getReference($chatRef,Chat::class));
            }
            
            $manager->persist($vitrine);
        }
        
        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            ChatFixtures::class,
            MemberFixtures::class,
        ];
    }
}