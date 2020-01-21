<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200117182018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transition_category ADD id_transition_type INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transition_category ADD CONSTRAINT FK_5209E314DBAA048D FOREIGN KEY (id_transition_type) REFERENCES transition_type (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5209E314DBAA048D ON transition_category (id_transition_type)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transition_category DROP FOREIGN KEY FK_5209E314DBAA048D');
        $this->addSql('DROP INDEX IDX_5209E314DBAA048D ON transition_category');
        $this->addSql('ALTER TABLE transition_category DROP id_transition_type');
    }
}
