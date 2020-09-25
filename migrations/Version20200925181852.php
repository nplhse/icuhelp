<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200925181852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sop_soptag (sop_id INT NOT NULL, soptag_id INT NOT NULL, INDEX IDX_5C041A8D52982EE (sop_id), INDEX IDX_5C041A8C1944B30 (soptag_id), PRIMARY KEY(sop_id, soptag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soptag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sop_soptag ADD CONSTRAINT FK_5C041A8D52982EE FOREIGN KEY (sop_id) REFERENCES sop (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sop_soptag ADD CONSTRAINT FK_5C041A8C1944B30 FOREIGN KEY (soptag_id) REFERENCES soptag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contact CHANGE category_id category_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sop_soptag DROP FOREIGN KEY FK_5C041A8C1944B30');
        $this->addSql('DROP TABLE sop_soptag');
        $this->addSql('DROP TABLE soptag');
        $this->addSql('ALTER TABLE contact CHANGE category_id category_id INT NOT NULL');
    }
}