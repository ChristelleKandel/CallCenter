<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713101206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'mettre un champs related to la table Champs dans Missions';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_champs (missions_id INT NOT NULL, champs_id INT NOT NULL, INDEX IDX_7590756917C042CF (missions_id), INDEX IDX_759075691ABA8B (champs_id), PRIMARY KEY(missions_id, champs_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_champs ADD CONSTRAINT FK_7590756917C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_champs ADD CONSTRAINT FK_759075691ABA8B FOREIGN KEY (champs_id) REFERENCES champs (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions_champs DROP FOREIGN KEY FK_7590756917C042CF');
        $this->addSql('ALTER TABLE missions_champs DROP FOREIGN KEY FK_759075691ABA8B');
        $this->addSql('DROP TABLE missions_champs');
    }
}
