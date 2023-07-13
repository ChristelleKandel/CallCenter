<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713133126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout societe_id dans mission';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions ADD societe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EFCF77503 FOREIGN KEY (societe_id) REFERENCES societe (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47EFCF77503 ON missions (societe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EFCF77503');
        $this->addSql('DROP INDEX IDX_34F1D47EFCF77503 ON missions');
        $this->addSql('ALTER TABLE missions DROP societe_id');
    }
}
