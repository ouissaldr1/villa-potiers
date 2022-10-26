<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727152029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description DROP FOREIGN KEY FK_6DE4402658ABF955');
        $this->addSql('DROP INDEX UNIQ_6DE4402658ABF955 ON description');
        $this->addSql('ALTER TABLE description DROP logement_id');
        $this->addSql('ALTER TABLE logement ADD chambre INT NOT NULL, ADD capacite INT NOT NULL, ADD salle_bain INT NOT NULL, ADD jardin TINYINT(1) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE description ADD logement_id INT NOT NULL');
        $this->addSql('ALTER TABLE description ADD CONSTRAINT FK_6DE4402658ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DE4402658ABF955 ON description (logement_id)');
        $this->addSql('ALTER TABLE logement DROP chambre, DROP capacite, DROP salle_bain, DROP jardin');
    }
}
