<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'link.users')
            ->setSearchFields(['id', 'username', 'roles', 'email']);
    }

    public function configureFields(string $pageName): iterable
    {
        $panel1 = FormField::addPanel('title.user_basics');
        $username = TextField::new('username', 'label.username');
        $email = EmailField::new('email', 'label.email');
        $plainPassword = TextField::new('plainPassword', 'label.password');
        $panel2 = FormField::addPanel('title.user_properties');
        $roles = ArrayField::new('roles');
        $id = IntegerField::new('id', 'label.id');
        $password = TextField::new('password');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $username, $email];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $username, $roles, $password, $email];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$panel1, $username, $email, $plainPassword, $panel2, $roles];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$panel1, $username, $email, $plainPassword, $panel2, $roles];
        }
    }
}
