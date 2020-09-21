<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200919083324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE is_verified is_verified TINYINT(1) NOT NULL, CHANGE is_active is_active TINYINT(1) NOT NULL, CHANGE is_credentials_non_expired is_credentials_non_expired TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE snippet CHANGE category_id category_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE snippet CHANGE category_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE is_verified is_verified TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_active is_active TINYINT(1) DEFAULT \'0\' NOT NULL, CHANGE is_credentials_non_expired is_credentials_non_expired TINYINT(1) DEFAULT \'1\' NOT NULL');
    }
}
