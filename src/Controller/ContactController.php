<?php

namespace App\Controller;


use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use const PHP_EOL;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(MailerInterface $mailer, Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            $contactMessage = (new Email())
                ->from($contactFormData->getEmail())
                ->to($this->getParameter('mailer_from'))
                ->subject("{$contactFormData->getFullName()} filled out the contact form")
                ->text(
                    'Sender: ' . $contactFormData->getFullName() . PHP_EOL .
                    'Email Address: ' . $contactFormData->getEmail() . PHP_EOL .
                    'Subject: ' . $contactFormData->getSubject() . PHP_EOL .
                    'Message: ' . $contactFormData->getMessage()
                );

            $mailer->send($contactMessage);

            $this->addFlash('success', 'Your message has been sent! We will contact you shortly!');

            return $this->redirectToRoute('app_home');
        }

        return $this->render('contact/index.html.twig', [
            'contact' => $form->createView()
        ]);
    }
}
