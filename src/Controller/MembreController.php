<?php

namespace App\Controller;

use App\Entity\Member; 
use App\Repository\MemberRepository; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/membre', name: 'app_membre_')]
final class MembreController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MemberRepository $MemberRepository): Response
    {
        return $this->render('membre/index.html.twig', [
            'membres' => $MemberRepository->findAll(),
        ]);
    }
    
    #[Route('/member/{id}', name: 'app_member_show', methods: ['GET'])]
    public function show(Member $member): Response
    {
        return $this->render('member/show.html.twig', [
            'member' => $member,
            'galeries' => $member->getGaleries(),
        ]);
    }
    
}
