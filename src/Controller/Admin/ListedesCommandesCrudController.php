<?php
// src/Controller/Admin/ListedesCommandesCrudController.php
namespace App\Controller\Admin;

use App\Entity\ListedesCommandes;
use App\Service\InvoiceGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ListedesCommandesCrudController extends AbstractCrudController
{
    private $invoiceGenerator;

    public function __construct(InvoiceGenerator $invoiceGenerator)
    {
        $this->invoiceGenerator = $invoiceGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return ListedesCommandes::class;
    }

    /**
     * Configure les champs affichés dans le CRUD.
     */
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('Id_comm'),
            TextField::new('Civilite'),
            TextField::new('Nom'),
            TextField::new('Prenom'),
            TextField::new('Adresse'),
            TextField::new('Ville'),
            TextField::new('InvoiceLink')
                // ->setLabel('Facture')
                // ->setHelp('Cliquez pour télécharger la facture.')
                // ->setFormTypeOptions([
                //     'disabled' => true, // Champ seulement en lecture pour le CRUD
                // ]),
        ];
    }

  

    #[Route("/admin/listedescommandes/{id}/invoice", "generate_invoice")]
    public function generateInvoice(ListedesCommandes $orderList): Response
    {
        $invoicePath = $this->invoiceGenerator->createInvoice($orderList);

        $response = new Response(file_get_contents($invoicePath));
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="invoice_' . $orderList->getIdComm() . '.pdf"');

        unlink($invoicePath);

        return $response;
    }
}
