<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\Tag;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MusicOne');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Tags', 'fas fa-list', Tag::class);
        yield MenuItem::linkToCrud('Address', 'fas fa-list', Address::class);
        yield MenuItem::linkToCrud('Place', 'fas fa-list', Place::class);
        yield MenuItem::linkToCrud('Event', 'fas fa-list', Event::class);
    }
}
