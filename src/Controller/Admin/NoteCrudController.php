<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NoteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Note::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'link.notes')
            ->setSearchFields(['id', 'name', 'category']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name', 'label.note.name');
        $category = TextField::new('category', 'label.note.category');
        $text = TextEditorField::new('text', 'label.note.category');
        $id = IntegerField::new('id', 'label.id');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $category];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $category, $text];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $category, $text];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $category, $text];
        }
    }
}
