<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Tag;
use App\Entity\Ville;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('preview')
            ->add('contenu', CKEditorType::class)
            ->add('image')
      /*      ->add('ville', VilleType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
                'multiple' =>true
        ])*/
         /*   ->add('tags', Tag::class, array(
                'class' => 'App\Entity\Tag',
                'choice_label' => 'name'*/

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
