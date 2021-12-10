<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\Type\EventType;
use App\Repository\EventRepository;
use App\Service\MailerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @Route("/event", name="event_main")
     */
    public function event(): Response
    {
        return $this->render('components/event/index.html.twig', [
            'events' => $this->eventRepository->findAll()
        ]);
    }

    /**
     * @Route("/event/{id}", name="event_single", requirements={"id"="\d+"} )
     */
    public function showEvent(Event $event): Response
    {
        return $this->render('components/event/single/index.html.twig', [
            'event' => $event
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/event/new", name="event_new" )
     */
    public function newEvent(MailerService $mailer, Request $request): Response
    {
        $event = new Event();
        $owner = $this->getUser();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->eventRepository->saveEvent($event, $owner);

            return $this->redirectToRoute('event_single', [
                'id' => $event->getId()
            ]);
        }
        return $this->render('components/event/create/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/event/{id}/edit", name="event_edit" )
     */
    public function editEvent(): Response
    {
        return $this->render('components/event/edit/index.html.twig');
    }
}
