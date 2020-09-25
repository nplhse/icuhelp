<?php

namespace App\Controller\Admin;

use App\Entity\SOP;
use App\Entity\SOPTag;
use App\Form\SOPTagType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SOPCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SOP::class;
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
        $name = TextField::new('name', 'label.description');
        $description = TextEditorField::new('description', 'label.description');
        $tags = CollectionField::new('tag', 'label.tags')
            ->allowAdd(true)
            ->allowDelete(true)
            ->setEntryType(SOPTagType::class);

        if (Crud::PAGE_INDEX === $pageName) {
            return [$id, $name];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$id, $name, $description, $tags];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $description, $tags];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $description, $tags];
        }
    }
}
