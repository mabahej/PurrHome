<?php

namespace App\Controller;

use App\Entity\Vitrine;
use App\Entity\Chat;
use App\Entity\Member;
use App\Form\VitrineType;
use App\Repository\VitrineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/vitrine')]
final class VitrineController extends AbstractController
{
    #[Route(name: 'app_vitrine_index', methods: ['GET'])]
    public function index(VitrineRepository $vitrineRepository): Response
    {
        return $this->render('vitrine/index.html.twig', [
            'vitrines' => $vitrineRepository->findBy(['publiee' => true]),
        ]);
    }
    
    #[Route('/vitrine/new/{id}', name: 'app_vitrine_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Member $membre): Response
    {
        // Create a single Vitrine for this member
        $vitrine = new Vitrine();
        $vitrine->setCreateur($membre);
        
        // Build the form
        $form = $this->createForm(VitrineType::class, $vitrine);
        $form->handleRequest($request);
        
        // Process the form
        if ($form->isSubmitted() && $form->isValid()) {
            // Get selected chats from the form (if applicable)
            $selectedChats = $form->get('chatsSelection')->getData() ?? [];
            
            // Add all selected chats to the same vitrine
            foreach ($selectedChats as $chat) {
                $vitrine->addChat($chat);
            }
            
            // Persist and flush once
            $entityManager->persist($vitrine);
            $entityManager->flush();
            
            // Redirect back to the member page
            return $this->redirectToRoute('app_membre_show', [
                'id' => $membre->getId(),
            ], Response::HTTP_SEE_OTHER);
        }
        
        // Render the form view
        return $this->render('vitrine/new.html.twig', [
            'vitrine' => $vitrine,
            'form' => $form,
        ]);
    }
    
    

    #[Route('/{id}', name: 'app_vitrine_show', methods: ['GET'])]
    public function show(Vitrine $vitrine): Response
    {
        return $this->render('vitrine/show.html.twig', [
            'vitrine' => $vitrine,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vitrine_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Vitrine $vitrine, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VitrineType::class, $vitrine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_membre_show', [
                'id' => $vitrine->getCreateur()->getId(),
            ], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vitrine/edit.html.twig', [
            'vitrine' => $vitrine,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vitrine_delete', methods: ['POST'])]
    public function delete(Request $request, Vitrine $vitrine, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vitrine->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vitrine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_membre_show', [
            'id' => $vitrine->getCreateur()->getId(),
        ], Response::HTTP_SEE_OTHER);
        
    }
    #[Route('/{vitrine_id}/chat/{chat_id}', name: 'app_vitrine_chat_show')]
    public function chatShow(
        #[MapEntity(id: 'vitrine_id')] Vitrine $vitrine,
        #[MapEntity(id: 'chat_id')] Chat $chat
        ): Response
        {
            if (!$vitrine->getChats()->contains($chat)) {
                throw $this->createNotFoundException("Ce chat n'appartient pas à cette vitrine !");
            }
            if (! $vitrine->isPubliee()) {
                 throw $this->createAccessDeniedException("You cannot access the requested resource!");
                }
                
            return $this->render('chat/show.html.twig', [
                'vitrine' => $vitrine,
                'chat' => $chat,
            ]);
    }
}
