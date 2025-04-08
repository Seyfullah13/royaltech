<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725143731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666444A2DB');
        $this->addSql('DROP INDEX UNIQ_23A0E666444A2DB ON article');
        $this->addSql('ALTER TABLE article DROP id_article, DROP designation, DROP prix, DROP categorie, CHANGE quantite_id ligne_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E665A438E76 FOREIGN KEY (ligne_id) REFERENCES ligne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E665A438E76 ON article (ligne_id)');
        $this->addSql('ALTER TABLE ligne ADD designation VARCHAR(100) NOT NULL, ADD categorie VARCHAR(100) NOT NULL, ADD quantite_vendue INT NOT NULL, DROP id_article, DROP id_comm, DROP quantite, CHANGE prix_unit prix DOUBLE PRECISION NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne ADD id_article VARCHAR(10) NOT NULL, ADD quantite INT NOT NULL, DROP designation, DROP categorie, CHANGE quantite_vendue id_comm INT NOT NULL, CHANGE prix prix_unit DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E665A438E76');
        $this->addSql('DROP INDEX UNIQ_23A0E665A438E76 ON article');
        $this->addSql('ALTER TABLE article ADD id_article VARCHAR(5) NOT NULL, ADD designation VARCHAR(100) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, ADD categorie VARCHAR(100) NOT NULL, CHANGE ligne_id quantite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666444A2DB FOREIGN KEY (quantite_id) REFERENCES ligne (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E666444A2DB ON article (quantite_id)');
    }
}
