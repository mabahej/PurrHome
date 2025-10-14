<?php

namespace App\Form;

use App\Entity\Chat;
use App\Entity\Member;
use App\Entity\Vitrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VitrineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo_url')
            ->add('description')
            ->add('publiee')
            ->add('chat', EntityType::class, [
                'class' => Chat::class,
                'choice_label' => 'id',
            ])
            ->add('createur', EntityType::class, [
                'class' => Member::class,
                'choice_label' => 'id',
            ])
            ->add('chats', EntityType::class, [
                'class' => Chat::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vitrine::class,
        ]);
    }
}
