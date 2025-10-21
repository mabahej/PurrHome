<?php

namespace App\Form;

use App\Entity\Chat;
use App\Entity\Refuge;
use App\Entity\Vitrine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Chat1Type extends AbstractType
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
        
        // Vitrines: show multiple selection, but we won't bind inverse side directly
        ->add('vitrinesSelection', EntityType::class, [
            'class' => Vitrine::class,
            'choice_label' => 'id', // or 'description'
            'multiple' => true,
            'mapped' => false,       // important! don't map to inverse property
            'required' => false,
        ])
        
        ->add('id_refuge', EntityType::class, [
            'class' => Refuge::class,
            'choice_label' => 'nom',
            'disabled' => true,
        ]);
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chat::class,
        ]);
    }
}
