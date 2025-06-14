<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => 'Nom d’utilisateur',
                'required' => true,
                'constraints' => [
                    new NotBlank(['groups' => ['creation']]),
                    new Length([
                        'min' => 3,
                        'max' => 20,
                        'groups' => ['creation']
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Utilisateur' => 'ROLE_USER',
                ],
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'required' => $options['is_new'],
                'constraints' => [
                    new NotBlank(['groups' => ['creation']]),
                    new Length([
                        'min' => 6,
                        'groups' => ['creation']
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'is_new' => false,
            'validation_groups' => function (FormInterface $form) {
                $groups = ['Default'];
                if ($form->getConfig()->getOption('is_new')) {
                    $groups[] = 'creation';
                }
                return $groups;
            },
        ]);
    }
}
