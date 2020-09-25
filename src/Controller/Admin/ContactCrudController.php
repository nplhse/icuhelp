<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'label.id');
        $name = TextField::new('name', 'label.name');
        $phone = TextField::new('phone', 'label.phone');
        $fax = TextField::new('fax', 'label.fax');
        $email = EmailField::new('email', 'label.email');
        $address = TextareaField::new('address', 'label.addess');
        $category = AssociationField::new('category', 'label.category');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $category];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $category];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $category, $phone, $fax, $email, $address];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $category, $phone, $fax, $email, $address];
        }
    }
}
