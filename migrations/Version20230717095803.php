<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230717095803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout de la propriete Type en relation avec la table TypsMission';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE missions ADD CONSTRAINT FK_34F1D47EC54C8C93 FOREIGN KEY (type_id) REFERENCES type_mission (id)');
        $this->addSql('CREATE INDEX IDX_34F1D47EC54C8C93 ON missions (type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions DROP FOREIGN KEY FK_34F1D47EC54C8C93');
        $this->addSql('DROP INDEX IDX_34F1D47EC54C8C93 ON missions');
        $this->addSql('ALTER TABLE missions DROP type_id');
    }
}
