<?php

namespace App\Controller\Admin;

use App\Entity\Snippet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SnippetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Snippet::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'link.snippets')
            ->setSearchFields(['id', 'name', 'text']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name', 'label.snippet.name');
        $category = AssociationField::new('category', 'label.snippet.category');
        $text = TextEditorField::new('text');
        $id = IntegerField::new('id', 'label.id');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $category];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $text, $category];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $category, $text];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $category, $text];
        }
    }
}
