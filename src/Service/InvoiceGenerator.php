<?php
// src/Service/InvoiceGenerator.php

namespace App\Service;

use Konekt\PdfInvoice\InvoicePrinter;
use App\Entity\ListedesCommandes;

class InvoiceGenerator
{
    private $invoicePrinter;

    public function __construct()
    {
        $this->invoicePrinter = new InvoicePrinter();
        $this->invoicePrinter->setLogo("logo_societe.png");
        $this->invoicePrinter->setColor("#fff");
        $this->invoicePrinter->setType("Facture");
    }

    public function createInvoice(ListedesCommandes $orderList): string
    {
      
        
        // Détails du client
        $this->invoicePrinter->setTo([
            $orderList->getCivilite() . ' ' . $orderList->getNom() . ' ' . $orderList->getPrenom(),
            $orderList->getAdresse(),
            $orderList->getVille()
        ]);

        // Ajoutez les articles de la commande à la facture
        $totalHT = 0; // Total HT
        foreach ($orderList->getArticles() as $article) {
            $quantity = $article->getQuantiteVendue(); // Assurez-vous que cette méthode est correcte
            $price = $article->getPrix();
            $total = $price * $quantity; // Total HT pour cet article
            $totalHT += $total;

            // Ajout de l'article à la facture
            $this->invoicePrinter->addItem(
                $article->getDesignation(), // Nom de l'article
                $article->getCategorie(),   // Description ou catégorie
                $quantity,                  // Quantité
                $price,                     // Prix unitaire
                $total,                     // Total HT pour cet article
                0,                         // Réduction, si applicable
                $total                      // Total avec réduction (ici, c'est le même que total HT)
            );
        }

        // Calcul des totaux
        $vatRate = 0.20; // 20% TVA
        $totalTTC = $totalHT * (1 + $vatRate); // Total TTC

        // Affichage des totaux
        $this->invoicePrinter->addTotal('Total HT', $totalHT);
        $this->invoicePrinter->addTotal('Total TTC', $totalTTC);

        $filePath = 'invoice_' . $orderList->getIdComm() . '.pdf';
        $this->invoicePrinter->render($filePath, 'F'); // 'F' pour sauvegarder le fichier

        return $filePath;
    }
}
