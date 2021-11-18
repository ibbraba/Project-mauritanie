<?php

namespace App\Form;

use App\Entity\Recit;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
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
            'uiColor' => '#d1d1d1',
            //...
        )))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recit::class,
        ]);
    }
}
