<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\GroupSequence;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class PasswordChangeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('currentPassword', PasswordType::class, [
                'label' => 'user.current_password',
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 4096,
                        'groups' => ['Password_Length'],
                    ]),
                    new NotBlank([
                        'message' => 'form_errors.global.not_blank',
                        'groups' => ['Password_Blank'],
                    ]),
                    new UserPassword([
                        'message' => 'form_errors.user.wrong_password',
                        'groups' => ['Password_Change'],
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'form_errors.user.repeat_password',
                'first_options' => [
                    'label' => 'user.new_password',
                ],
                'second_options' => [
                    'label' => 'user.new_password_repeat',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            /*
             * GroupSequence will validate constraints sequentially by iterating through the array, it means that if
             * password length validation fails, length error will be shown and validation will stop there.
             * UserPassword validation will not be triggered, thus preventing potential server load (or even DoS?)
             * if a very long password is being hashed.
             */
            'validation_groups' => new GroupSequence([
                'Password_Length',
                'Password_Blank',
                'Password_Change',
            ]),
        ]);
    }
}
