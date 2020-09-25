<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\ContactCategory;
use App\Repository\ContactCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    private $contactCategoryRepository;

    public function __construct(ContactCategoryRepository $contactCategoryRepository)
    {
        $this->contactCategoryRepository = $contactCategoryRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('address')
            ->add('category', EntityType::class, [
                'class' => ContactCategory::class,
                'choices' => $this->contactCategoryRepository->findByNameAlphabetically(),
                'placeholder' => 'msg.choose.contact.category',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
