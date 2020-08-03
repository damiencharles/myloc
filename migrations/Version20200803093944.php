<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200803093944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC386F917CCFC');
        $this->addSql('DROP INDEX idx_45edc386f917ccfc ON bien');
        $this->addSql('CREATE INDEX IDX_45EDC38676C50E4A ON bien (proprietaire_id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC386F917CCFC FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pret CHANGE points_pret points_pret INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', CHANGE points points INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bien DROP FOREIGN KEY FK_45EDC38676C50E4A');
        $this->addSql('DROP INDEX idx_45edc38676c50e4a ON bien');
        $this->addSql('CREATE INDEX IDX_45EDC386F917CCFC ON bien (proprietaire_id)');
        $this->addSql('ALTER TABLE bien ADD CONSTRAINT FK_45EDC38676C50E4A FOREIGN KEY (proprietaire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pret CHANGE points_pret points_pret INT DEFAULT 50 NOT NULL');
        $this->addSql('ALTER TABLE user DROP role, CHANGE points points INT DEFAULT NULL');
    }
}
