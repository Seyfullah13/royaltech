<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725120033 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, id_article VARCHAR(10) NOT NULL, id_comm INT NOT NULL, quantite INT NOT NULL, prix_unit DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE client ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE commande ADD id INT AUTO_INCREMENT NOT NULL, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ligne');
        $this->addSql('ALTER TABLE article MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON article');
        $this->addSql('ALTER TABLE article DROP id');
        $this->addSql('ALTER TABLE client MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON client');
        $this->addSql('ALTER TABLE client DROP id');
        $this->addSql('ALTER TABLE commande MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON commande');
        $this->addSql('ALTER TABLE commande DROP id');
    }
}
