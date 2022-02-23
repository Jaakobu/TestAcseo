<?php

namespace App\Controller;

use JsonCreator;
use App\Entity\Message;
use App\Form\MessageFormType;
use Doctrine\ORM\EntityManager;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Filesystem\Exception\IOException;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MessageController extends AbstractController
{
    /**
     * @Route("/message", name="message")
     */
    public function message(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        $message = new Message();

        $contactForm = $this->createForm(MessageFormType::class, $message);
        $contactForm->handleRequest($request);


        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $message->setCreatedAt(new \DateTime());
            $message->setmessageRead(false);

            $json = $serializer->serialize($message, 'json');
            //dd($json);
            $entityManager->persist($message);
            $entityManager->flush();

            $fs = new \Symfony\Component\Filesystem\Filesystem();

            try {
                $fileName = 'DemandeId' . '_' . $message->getId() . '_' . $message->getNom() . '_' . $message->getPrenom();
                $fs->dumpFile('../private/json/test/' . $fileName . '.json', $json);
            } catch (IOException $e) {
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('message/contactMessage.html.twig', [

            'messageForm' => $contactForm->createView(),

        ]);
    }


    /**
     * @Route("/admin/messages", name="messages")
     */
    public function messageUserList(MessageRepository $messageRepository): Response
    {
        $messageClient = $messageRepository->findAllGroupBy('email');

        return $this->render('admin/messagerie/messageUserList.html.twig', [
            'demandeClients' => $messageClient,
        ]);
    }

    /**
     * @Route("/admin/messages/{email}", name="messages-par-user")
     */
    public function messageUserShow($email, MessageRepository $messageRepository): Response
    {
        $messageClient = $messageRepository->findBy(['email' => $email]);

        return $this->render('admin/messagerie/messageUserMessages.html.twig', [
            'demandeClients' => $messageClient,
        ]);
    }

    /**
     * @Route("/validation-message/{id}", name="message_lu")
     */
    public function validateSouscriptionAction($id, MessageRepository $messageRepository, EntityManagerInterface $entityManager)
    {
        $message = $messageRepository->find($id);
        $message->getMessageRead() ? $message->setMessageRead(false) : $message->setMessageRead(true);

        $entityManager->persist($message);
        $entityManager->flush();

        return $this->redirectToRoute("messages-par-user", ['email' => $message->getEmail()]);
    }
}
