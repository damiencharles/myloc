<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use App\Entity\Pret;
use App\Entity\User;
use App\Entity\Categorie;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        //return parent::index();
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Myloc');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Users');
        yield MenuItem::linktoCrud('Users', 'fas fa-user-circle', User::class);
        yield MenuItem::section('Categories');
        yield MenuItem::linktoCrud('Categories', 'fa fa-tags', Categorie::class);
        yield MenuItem::section('Biens');
        yield MenuItem::linktoCrud('Biens', 'fa fa-toolbox', Bien::class);
        yield MenuItem::section('Prets');
        yield MenuItem::linktoCrud('Prets', 'fa fa-handshake', Pret::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
