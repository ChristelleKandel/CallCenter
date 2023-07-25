<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725125304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout champs';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champs ADD position VARCHAR(255) DEFAULT NULL, ADD triable TINYINT(1) DEFAULT NULL, ADD obligatoire TINYINT(1) DEFAULT NULL, ADD multiple TINYINT(1) DEFAULT NULL, ADD value_multiple VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE champs DROP position, DROP triable, DROP obligatoire, DROP multiple, DROP value_multiple');
    }
}
