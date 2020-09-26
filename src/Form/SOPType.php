<?php

namespace App\Form;

use App\Entity\SOP;
use App\Form\DataTransformer\SOPTagToCollectionTransformer;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class SOPType extends AbstractType
{
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('sopFile', FileType::class, [
                'label' => 'Attachment',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'application/msword',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/mspowerpoint',
                            'image/jpeg',
                            'image/gif',
                            'image/png',
                            'image/svg+xml',
                        ],
                        'mimeTypesMessage' => 'Please only upload a supported file format',
                    ]),
                ],

                'help' => 'Supported file formats are PDF, MS-Word, MS-Powerpoint, JPEG, GIF, PNG& SVG',
            ])
            ->add('tag', CollectionType::class, [
                'entry_type' => SOPTagType::class,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'required' => false,
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SOP::class,
        ]);
    }
}
