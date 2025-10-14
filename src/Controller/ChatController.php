<?php

namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Chat;  // ← CETTE LIGNE EST ESSENTIELLE

final class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(EntityManagerInterface $em): Response
    {
        // Fetch all chats
        $chats = $em->getRepository(Chat::class)->findAll();
        
        return $this->render('chat/index.html.twig', [
            'chats' => $chats,
        ]);
    }
    #[Route('/chat/{id}', name: 'chat_show')]
    public function show(Chat $chat): Response
    {
        return $this->render('chat/show.html.twig', [
            'chat' => $chat,
        ]);
    }
}
