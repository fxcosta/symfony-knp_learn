<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160710133813 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_notes ADD genus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE genus_notes ADD CONSTRAINT FK_B2D619A485C4074C FOREIGN KEY (genus_id) REFERENCES genus (id)');
        $this->addSql('CREATE INDEX IDX_B2D619A485C4074C ON genus_notes (genus_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE genus_notes DROP FOREIGN KEY FK_B2D619A485C4074C');
        $this->addSql('DROP INDEX IDX_B2D619A485C4074C ON genus_notes');
        $this->addSql('ALTER TABLE genus_notes DROP genus_id');
    }
}
