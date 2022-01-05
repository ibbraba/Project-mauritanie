<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            //INDEX
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action){
        return $action->setLabel("Voir L'article");
        })
        ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action){
            return $action->setLabel("Modifier");
        })
        ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action){
            return $action->setLabel("Supprimer");
        })
        ->update(Crud::PAGE_INDEX, Action::NEW,  function (Action $action){
            return $action->setLabel("Créer un article");
            })


        //EDIT
        ->add(Crud::PAGE_EDIT, Action::INDEX)
        ->update(Crud::PAGE_EDIT, Action::INDEX, function (Action $action){
            return $action->setLabel("Retour à liste des articles");
        })
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action){
            return $action->setLabel("Sauvegarder et cocntinuer les changements");
        })
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action){
            return $action ->setLabel("Sauvegarder");
        })
            //DETAILS
        ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action){
            return $action->setLabel("Supprimer");
            })
        ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action){
        return $action->setLabel("Modifier");
            })
        ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action){
            return $action->setLabel("Retour à la liste des posts");
            });

    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('titre')->setLabel("Titre"),
            TextEditorField::new('preview')->setLabel("Preview"),
            AssociationField::new("tags")->setLabel("Tag")->hideOnIndex(),
            AssociationField::new("ville")->setLabel("Ville"),
            IntegerField::new("views")->setDisabled(),
            DateTimeField::new("date")->setLabel("Crée le")->setDisabled(),

            ImageField::new("image")->setLabel("Image")->hideOnIndex(),
            TextEditorField::new("contenu")->hideOnIndex()->setLabel("Contenu"),

        ];
    }

}
