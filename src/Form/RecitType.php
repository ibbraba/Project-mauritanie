<?php

namespace App\Form;

use App\Entity\Recit;
use App\Entity\Tag;
use App\Entity\Ville;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author')
            ->add('titre')
            ->add('description')
            ->add('image')
            ->add('content', CKEditorType::class,  array(
        'config' => array(
            'uiColor' => '#d1d1d1')))
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
                'multiple' => true

            ])
            ->add('tags',EntityType::class , array(
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true

            ))
            //...


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recit::class,
        ]);
    }
}
