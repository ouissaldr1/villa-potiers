<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727115104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE description (id INT AUTO_INCREMENT NOT NULL, logement_id INT NOT NULL, salle_bain INT NOT NULL, chambre INT NOT NULL, capacite INT NOT NULL, jardin TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_6DE4402658ABF955 (logement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE description ADD CONSTRAINT FK_6DE4402658ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495578867BF4');
        $this->addSql('DROP INDEX UNIQ_42C8495578867BF4 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE id_villa_id logement_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495558ABF955 FOREIGN KEY (logement_id) REFERENCES logement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C8495558ABF955 ON reservation (logement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE description');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495558ABF955');
        $this->addSql('DROP INDEX UNIQ_42C8495558ABF955 ON reservation');
        $this->addSql('ALTER TABLE reservation CHANGE logement_id id_villa_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495578867BF4 FOREIGN KEY (id_villa_id) REFERENCES logement (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C8495578867BF4 ON reservation (id_villa_id)');
    }
}
