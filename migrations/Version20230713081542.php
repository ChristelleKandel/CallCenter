<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713081542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout de fields dans entity Champs';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champs ADD nullable TINYINT(1) NOT NULL, ADD extras VARCHAR(255) DEFAULT NULL, ADD visible_form TINYINT(1) NOT NULL, ADD modifiable_client TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE users ADD societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9FCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_1483A5E9FCF77503 ON users (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
