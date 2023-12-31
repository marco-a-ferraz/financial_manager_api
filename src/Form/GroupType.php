<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Group;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, CheckboxType};
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class GroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class)
            ->add('active', CheckboxType::class)
            ->add(
                'users',
                EntityType::class,
                [
                    'class' => User::class,
                    'multiple' => true,
                    'choice_value' => function (User $user): string {
                        return $user ? $user->getUsername() : '';
                    },
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Group::class,
            'csrf_protection' => false
        ]);
    }
}
