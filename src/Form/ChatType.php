<?php

namespace App\Form;

use App\Entity\Chat;
use App\Entity\Refuge;
use App\Entity\Vitrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('age')
            ->add('race')
            ->add('sexe')
            ->add('etat_sante')
            ->add('statut')
         
            ->add('vitrines', EntityType::class, [
                'class' => Vitrine::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        
            ->add('description')
            ->add('id_refuge', EntityType::class, [
                'class' => Refuge::class,
                'choice_label' => 'nom', // show refuge name instead of ID
                'disabled' => true,      // disable editing
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chat::class,
        ]);
    }
}
