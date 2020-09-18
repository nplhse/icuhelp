<?php

namespace App\Form;

use App\Entity\Note;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category', ChoiceType::class, [
                'choices'  => [
                    'label.note.category.onboarding' => 'onboarding',
                    'label.note.category.note' => 'note',
                    'label.note.category.info' => 'info',
                ]])
            ->add('text', CKEditorType::class, [
                'config_name' => 'snippets',
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Note::class,
        ]);
    }
}
