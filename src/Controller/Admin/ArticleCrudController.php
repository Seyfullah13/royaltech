<?php
namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'), // Hide ID field on forms as it is auto-generated
            TextField::new('designation'),
            NumberField::new('prix'),
            TextField::new('categorie'),
            NumberField::new('quantite_vendue'), // Hide computed field on forms
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        
            
    
        return $actions
        
    
            // you can set permissions for built-in actions in the same way
            ->setPermission(Action::BATCH_DELETE, 'ROLE_EDITION')
            ->setPermission(Action::EDIT, 'ROLE_EDITION')
            ->setPermission(Action::DELETE, 'ROLE_EDITION')
            ->setPermission(Action::NEW, 'ROLE_EDITION')
        ;
    }
}
