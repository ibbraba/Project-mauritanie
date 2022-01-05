<?php

namespace App\Controller\Admin;

use App\Entity\Recit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class RecitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recit::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            //INDEX
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel("Créer un  récit");
            })
            //->add(Crud::PAGE_INDEX, Action::DELETE)
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel("Supprimer");
            })
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setLabel("Details du récit");
            })
            // ->add(Crud::PAGE_INDEX, Action::EDIT)
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel("Modifier");
            })

            //EDIT
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel("Sauvegarder");
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel("Sauvegarder les changements et continuer");
            })
            ->add(Crud::PAGE_EDIT, Action::INDEX)
            ->update(Crud::PAGE_EDIT, Action::INDEX,  function (Action $action){
                return $action->setLabel("Retour à la liste des récits");
            })

            //DETAIL
            ->update(Crud::PAGE_DETAIL, Action::INDEX,  function (Action $action){
                return $action->setLabel("Retour à la liste des récits");
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE,  function (Action $action){
                return $action->setLabel("Supprimer");})
            ->update(Crud::PAGE_DETAIL, Action::EDIT,  function (Action $action){
                return $action->setLabel("Editer");
            });


    }

    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('titre')->setLabel("Titre"),
            TextField::new('description')->setLabel("Previw"),
            TextField::new("author")->setLabel("Auteur"),
            DateTimeField::new("date")->setLabel("Crée le:"),
            IntegerField::new("views")->setLabel("Vues")->setDisabled(),

            AssociationField::new("tags")->setLabel("Tag")->hideOnIndex(),
            AssociationField::new("ville")->setLabel("Ville")->hideOnIndex(),
            TextEditorField::new("content")->setLabel("Contenu")->hideOnIndex(),
            ImageField::new("imnage")->setLabel("Image")->hideOnIndex(),
        ];
    }

}
