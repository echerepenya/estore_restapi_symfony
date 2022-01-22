<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Country;
use App\Entity\Locale;
use App\Entity\Product;
use App\Entity\Vat;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    
    
    #[Route('/', name: 'admin')]
    public function index(): Response
    {
        //$routeBuilder = $this->get(AdminUrlGenerator::class);
        //$url = $routeBuilder->setController(LocaleCrudController::class)->generateUrl();
        $url = $this->adminUrlGenerator->setController(LocaleCrudController::class)->generateUrl();
        return $this->redirect($url);

        
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Estore Api');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linktoRoute('To API', 'fas fa-home', '/api'),
            yield MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
            yield MenuItem::linkToCrud('Locales', 'fa fa-tags', Locale::class),
            yield MenuItem::linkToCrud('Countries', 'fa fa-tags', Country::class),
            yield MenuItem::linkToCrud('VAT rates', 'fa fa-tags', Vat::class),
            yield MenuItem::linkToCrud('Products', 'fa fa-tags', Product::class)
        ];
    }
}
