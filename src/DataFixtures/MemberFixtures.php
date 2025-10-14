<?php
namespace App\DataFixtures;

use App\Entity\Member;
use App\Entity\Refuge;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class MemberFixtures extends Fixture implements DependentFixtureInterface
{
    public const MEMBER_PARIS = 'member-paris';
    public const MEMBER_LYON = 'member-lyon';
    public const MEMBER_MARSEILLE = 'member-marseille';
    public const MEMBER_TOULOUSE = 'member-toulouse';
    
    private UserPasswordHasherInterface $passwordHasher;
    
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    
    public function load(ObjectManager $manager): void
    {
        $member1 = new Member();
        $member1->setEmail('refuge.paris@example.com');
        $member1->setPassword($this->passwordHasher->hashPassword($member1, 'password123'));
        $member1->setRoles(['ROLE_REFUGE']);
        $member1->setRefuge($this->getReference(RefugeFixtures::REFUGE_PARIS, Refuge::class));
        $manager->persist($member1);
        $this->addReference(self::MEMBER_PARIS, $member1);
        
        $member2 = new Member();
        $member2->setEmail('refuge.lyon@example.com');
        $member2->setPassword($this->passwordHasher->hashPassword($member2, 'password123'));
        $member2->setRoles(['ROLE_REFUGE']);
        $member2->setRefuge($this->getReference(RefugeFixtures::REFUGE_LYON, Refuge::class));
        $manager->persist($member2);
        $this->addReference(self::MEMBER_LYON, $member2);
        
        $member3 = new Member();
        $member3->setEmail('refuge.marseille@example.com');
        $member3->setPassword($this->passwordHasher->hashPassword($member3, 'password123'));
        $member3->setRoles(['ROLE_REFUGE', 'ROLE_ADMIN']);
        $member3->setRefuge($this->getReference(RefugeFixtures::REFUGE_MARSEILLE, Refuge::class));
        $manager->persist($member3);
        $this->addReference(self::MEMBER_MARSEILLE, $member3);
        
        $member4 = new Member();
        $member4->setEmail('refuge.toulouse@example.com');
        $member4->setPassword($this->passwordHasher->hashPassword($member4, 'password123'));
        $member4->setRoles(['ROLE_REFUGE']);
        $member4->setRefuge($this->getReference(RefugeFixtures::REFUGE_TOULOUSE, Refuge::class));
        $manager->persist($member4);
        $this->addReference(self::MEMBER_TOULOUSE, $member4);
        
        $manager->flush();
    }
    
    public function getDependencies(): array
    {
        return [
            RefugeFixtures::class,
        ];
    }
}
