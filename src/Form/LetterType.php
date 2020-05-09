<?php

namespace App\Form;

use App\Entity\Snippet;
use App\Form\Model\LetterTypeModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'label.letter.name'])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'label.choice.male' => 'label.choice.male',
                    'label.choice.female' => 'label.choice.female',
                    ],
                'label' => 'label.gender',
                ])
            ->add('snippets', EntityType::class, [
                'class' => Snippet::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.category', 'ASC');
                },
                'expanded' => true,
                'multiple' => true,
                'group_by' => function (Snippet $snippet) {
                    return $snippet->getCategory();
                },
                'label' => 'label.snippets',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => LetterTypeModel::class,
        ]);
    }
}
