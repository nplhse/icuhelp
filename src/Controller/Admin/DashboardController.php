<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\ContactCategory;
use App\Entity\Info;
use App\Entity\Note;
use App\Entity\Snippet;
use App\Entity\SnippetCategory;
use App\Entity\SOP;
use App\Entity\SOPTag;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ICUhelp');
    }

    public function configureCrud(): Crud
    {
        return Crud::new();
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return UserMenu::new()
            ->displayUserAvatar(false);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-home');
        yield MenuItem::linktoRoute('link.frontend', 'fas fa-power-off', 'homepage');
        yield MenuItem::section('Benutzer');
        yield MenuItem::linkToCrud('link.users', 'fas fa-users', User::class);
        yield MenuItem::section('Inhalte');
        yield MenuItem::linkToCrud('link.contacts', 'fa fa-address-book', Contact::class);
        yield MenuItem::linkToCrud('link.contact.categories', 'fa fa-tags', ContactCategory::class);
        yield MenuItem::linkToCrud('link.info', 'fa fa-info-circle', Info::class);
        yield MenuItem::linkToCrud('link.notes', 'fa fa-sticky-note', Note::class);
        yield MenuItem::linkToCrud('link.sop', 'fa fa-clinic-medical', SOP::class);
        yield MenuItem::linkToCrud('link.sop.tags', 'fa fa-tags', SOPTag::class);
        yield MenuItem::linkToCrud('link.snippets', 'far fa-clipboard', Snippet::class);
        yield MenuItem::linkToCrud('link.snippet.category', 'fas fa-tags', SnippetCategory::class);
    }
}
