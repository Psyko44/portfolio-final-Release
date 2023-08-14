<?php

namespace App\Controller;

use App\Entity\ContactMessages;
use App\Form\ContactMessagesType;
use App\Repository\ContactMessagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/message/admin')]
class MessageAdminController extends AbstractController
{
    #[Route('/', name: 'app_message_admin_index', methods: ['GET'])]
    public function index(ContactMessagesRepository $contactMessagesRepository): Response
    {
        return $this->render('message_admin/index.html.twig', [
            'contact_messages' => $contactMessagesRepository->findAll(),
        ]);
    }



    #[Route('/{id}', name: 'app_message_admin_delete', methods: ['POST'])]
    public function delete(Request $request, ContactMessages $contactMessage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contactMessage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_message_admin_index', [], Response::HTTP_SEE_OTHER);
    }
}
