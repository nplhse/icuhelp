<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200929155147 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload ADD note_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61F26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('CREATE INDEX IDX_17BDE61F26ED0855 ON upload (note_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload DROP FOREIGN KEY FK_17BDE61F26ED0855');
        $this->addSql('DROP INDEX IDX_17BDE61F26ED0855 ON upload');
        $this->addSql('ALTER TABLE upload DROP note_id');
    }
}
