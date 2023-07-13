<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230710101935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'création de la table Missions';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE missions (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, script LONGTEXT NOT NULL, commentaires LONGTEXT NOT NULL, email_rdv_client_text LONGTEXT DEFAULT NULL, email_rdv_prospect_text LONGTEXT DEFAULT NULL, champs LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:object)\', rdv_date DATETIME DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE missions_users (missions_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_CE5EC0D317C042CF (missions_id), INDEX IDX_CE5EC0D367B3B43D (users_id), PRIMARY KEY(missions_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE missions_users ADD CONSTRAINT FK_CE5EC0D317C042CF FOREIGN KEY (missions_id) REFERENCES missions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE missions_users ADD CONSTRAINT FK_CE5EC0D367B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE missions_users DROP FOREIGN KEY FK_CE5EC0D317C042CF');
        $this->addSql('ALTER TABLE missions_users DROP FOREIGN KEY FK_CE5EC0D367B3B43D');
        $this->addSql('DROP TABLE missions');
        $this->addSql('DROP TABLE missions_users');
    }
}
