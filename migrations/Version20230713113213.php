<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230713113213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'ajout tables statuts et prerempli';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions_statuts (missions_id INT NOT NULL, statuts_id INT NOT NULL, INDEX IDX_5844949517C042CF (missions_id), INDEX IDX_58449495E0EA5904 (statuts_id), PRIMARY KEY(missions_id, statuts_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_prerempli (missions_id INT NOT NULL, prerempli_id INT NOT NULL, INDEX IDX_D5E85D6C17C042CF (missions_id), INDEX IDX_D5E85D6CEAEE3812 (prerempli_id), PRIMARY KEY(missions_id, prerempli_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prerempli (id INT AUTO_INCREMENT NOT NULL, texte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statuts (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, definitif TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_statuts ADD CONSTRAINT FK_5844949517C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_statuts ADD CONSTRAINT FK_58449495E0EA5904 FOREIGN KEY (statuts_id) REFERENCES statuts (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_prerempli ADD CONSTRAINT FK_D5E85D6C17C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_prerempli ADD CONSTRAINT FK_D5E85D6CEAEE3812 FOREIGN KEY (prerempli_id) REFERENCES prerempli (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions_statuts DROP FOREIGN KEY FK_5844949517C042CF');
        $this->addSql('ALTER TABLE missions_statuts DROP FOREIGN KEY FK_58449495E0EA5904');
        $this->addSql('ALTER TABLE missions_prerempli DROP FOREIGN KEY FK_D5E85D6C17C042CF');
        $this->addSql('ALTER TABLE missions_prerempli DROP FOREIGN KEY FK_D5E85D6CEAEE3812');
        $this->addSql('DROP TABLE missions_statuts');
        $this->addSql('DROP TABLE missions_prerempli');
        $this->addSql('DROP TABLE prerempli');
        $this->addSql('DROP TABLE statuts');
    }
}
