<?php
namespace App\Controller;

use App\Entity\Refuge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RefugeController extends AbstractController
{
    #[Route('/refuge', name: 'app_refuge')]
    public function index(EntityManagerInterface $em): Response
    {
        $refuges = $em->getRepository(Refuge::class)->findAll();
        
        return $this->render('refuge/list.html.twig', [
            'refuges' => $refuges,
        ]);
    }
    
    #[Route('/refuge/{id}', name: 'refuge_show')]
    public function show(Refuge $refuge): Response
    {
        return $this->render('refuge/show.html.twig', [
            'refuge' => $refuge,
        ]);
    }
}