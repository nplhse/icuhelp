<?php

namespace App\Controller\Admin;

use App\Entity\Note;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
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
        $id = IntegerField::new('id', 'label.id');
        $name = TextField::new('name', 'label.note.name');
        $category = TextField::new('category', 'label.note.category');
        $text = TextEditorField::new('text', 'label.note.category');
        $createdAt = DateTimeField::new('createdAt', 'label.note.createdAt');
        $updatedAt = DateTimeField::new('updatedAt', 'label.note.updatedAt');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $category, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $category, $text, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $category, $text, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $category, $text, $createdAt, $updatedAt];
        }
    }
}
