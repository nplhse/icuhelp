<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use App\Entity\Snippet;
use App\Entity\SnippetCategory;
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
        yield MenuItem::section('Textbausteine');
        yield MenuItem::linkToCrud('link.snippets', 'far fa-clipboard', Snippet::class);
        yield MenuItem::linkToCrud('link.snippet.category', 'fas fa-folder-open', SnippetCategory::class);
        yield MenuItem::section('Notzien');
        yield MenuItem::linkToCrud('link.notes', 'far fa-sticky-note', Note::class);
    }
}