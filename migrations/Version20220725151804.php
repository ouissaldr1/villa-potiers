<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220725151804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD id_villa_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495578867BF4 FOREIGN KEY (id_villa_id) REFERENCES villa (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C8495578867BF4 ON reservation (id_villa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495578867BF4');
        $this->addSql('DROP INDEX UNIQ_42C8495578867BF4 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP id_villa_id');
    }
}
