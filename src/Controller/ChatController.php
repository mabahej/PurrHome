<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Refuge;
use App\Form\Chat1Type;
use App\Repository\ChatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/chat')]
final class ChatController extends AbstractController
{
    #[Route(name: 'app_chat_index', methods: ['GET'])]
    public function index(ChatRepository $chatRepository): Response
    {
        return $this->render('chat/index.html.twig', [
            'chats' => $chatRepository->findAll(),
        ]);
    }

    #[Route('/chat/new/{id}', name: 'app_chat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Refuge $refuge): Response
    {
        $chat = new Chat();
        $chat->setIdRefuge($refuge); // link this chat to the refuge
        
        $form = $this->createForm(Chat1Type::class, $chat);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($chat);
            $entityManager->flush();
            
            // redirect to refuge show page after adding the chat
            return $this->redirectToRoute('app_refuge_show', [
                'id' => $refuge->getId(),
            ], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('chat/new.html.twig', [
            'chat' => $chat,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}/edit', name: 'app_chat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Chat $chat, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Chat1Type::class, $chat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'refuge_show',
                ['id' => $chat->getIdRefuge()->getId()],
                Response::HTTP_SEE_OTHER
                );
        }

        return $this->render('chat/edit.html.twig', [
            'chat' => $chat,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_chat_delete', methods: ['POST'])]
    public function delete(Request $request, Chat $chat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$chat->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($chat);
            $entityManager->flush();
        }

        return $this->redirectToRoute(
            'refuge_show',
            ['id' => $chat->getIdRefuge()->getId()],
            Response::HTTP_SEE_OTHER
            );
    }
}
