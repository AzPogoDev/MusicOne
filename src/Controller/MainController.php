<?php

namespace App\Controller;

use App\Form\Type\ContactType;
use App\Model\Contact;
use App\Service\MailerService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main_index")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/contact", name="main_contact")
     */
    public function contact(Request $request, MailerService $mailer)
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($mailer->sendSupport($contact)) {
                $this->addFlash('notice', 'Formulaire envoyé');
            } else {
                $this->addFlash('erro', 'Ton message marche pas chakal');
            }

            return $this->redirectToRoute('main_contact');

        }
        return $this->render('main/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
