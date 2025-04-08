<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240725133325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD quantite_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E666444A2DB FOREIGN KEY (quantite_id) REFERENCES ligne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E666444A2DB ON article (quantite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E666444A2DB');
        $this->addSql('DROP INDEX UNIQ_23A0E666444A2DB ON article');
        $this->addSql('ALTER TABLE article DROP quantite_id');
    }
}
