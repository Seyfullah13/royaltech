<?php

namespace App\DataFixtures;

use App\Entity\NonCommandes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class NonCommandesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Liste de catégories possibles pour les produits
        $categories = ['Électronique', 'Vêtements', 'Meubles', 'Accessoires', 'Alimentaire', 'Jouets', 'Sports', 'Maison'];

        for ($i = 0; $i < 20; $i++) {
            $nonCommande = new NonCommandes();

            // Désignation d'un produit : Nom de produit réaliste
            $designation = $faker->word . ' ' . ucfirst($faker->word); // Exemple: "Smartphone Huawei" ou "Chaise Ergonomique"
            $nonCommande->setDesignation($designation);

            // Prix unitaire réaliste : Entre 10 et 1500 €, avec 2 décimales
            $prixUnitaire = $faker->randomFloat(2, 10, 1500);
            $nonCommande->setPrixUnitaire($prixUnitaire);

            // Catégorie aléatoire parmi une liste prédéfinie
            $categorie = $categories[array_rand($categories)];
            $nonCommande->setCategorie($categorie);

            // Persister l'objet
            $manager->persist($nonCommande);
        }

        // Sauvegarder les objets dans la base de données
        $manager->flush();
    }
}
