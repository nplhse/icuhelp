<?php

namespace App\Controller\Admin;

use App\Entity\SnippetCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SnippetCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SnippetCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'link.snippet.category')
            ->setSearchFields(['id', 'name', 'priority']);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'label.id');
        $name = TextField::new('name', 'label.snippet.category.name');
        $priority = IntegerField::new('priority', 'label.snippet.category.priority');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $priority];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $priority];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $priority];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $priority];
        }

        return null;
    }
}
