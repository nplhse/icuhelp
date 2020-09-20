<?php

namespace App\Controller\Admin;

use App\Entity\Info;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Info::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'link.info')
            ->setSearchFields(['id', 'name']);
    }

    public function configureFields(string $pageName): iterable
    {
        $id = IntegerField::new('id', 'label.id');
        $name = TextField::new('name', 'label.info.name');
        $text = TextEditorField::new('text', 'label.note.text');
        $createdAt = DateTimeField::new('createdAt', 'label.note.createdAt');
        $updatedAt = DateTimeField::new('updatedAt', 'label.note.updatedAt');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $text, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $text, $createdAt, $updatedAt];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $text, $createdAt, $updatedAt];
        }
    }
}
