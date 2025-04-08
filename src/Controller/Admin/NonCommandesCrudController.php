<?php

namespace App\Controller\Admin;

use App\Entity\NonCommandes;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NonCommandesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NonCommandes::class;
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
