<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230603130929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE joueur (matriculejoueur INT NOT NULL, idpartie_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, score INT NOT NULL, INDEX IDX_FD71A9C59E6E5E51 (idpartie_id), PRIMARY KEY(matriculejoueur)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE joueur ADD CONSTRAINT FK_FD71A9C59E6E5E51 FOREIGN KEY (idpartie_id) REFERENCES partie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE joueur DROP FOREIGN KEY FK_FD71A9C59E6E5E51');
        $this->addSql('DROP TABLE joueur');
    }
}
