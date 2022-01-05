<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Recit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin-index", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Zone Mauritanienne');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Acceuil', 'fa fa-home');

        yield MenuItem::section("Posts");
        yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Récits', 'fas fa-list', Recit::class);
    }
}
