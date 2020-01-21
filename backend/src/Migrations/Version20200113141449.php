<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200113141449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_account (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, id_account INT DEFAULT NULL, INDEX IDX_253B48AE6B3CA4B (id_user), INDEX IDX_253B48AEA3ABFFD4 (id_account), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transition_type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(40) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login_user (id INT AUTO_INCREMENT NOT NULL, id_login INT DEFAULT NULL, id_user INT DEFAULT NULL, INDEX IDX_4BE15D0C448D8A20 (id_login), INDEX IDX_4BE15D0C6B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transition_category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(40) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transition (id VARCHAR(100) NOT NULL, id_account INT DEFAULT NULL, id_transition_type INT DEFAULT NULL, id_transition_category INT DEFAULT NULL, value DOUBLE PRECISION NOT NULL, date DATETIME NOT NULL, fixed TINYINT(1) DEFAULT NULL, note VARCHAR(50) NOT NULL, tag VARCHAR(20) NOT NULL, INDEX IDX_F715A75AA3ABFFD4 (id_account), INDEX IDX_F715A75ADBAA048D (id_transition_type), INDEX IDX_F715A75A14E37FDF (id_transition_category), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE login (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(40) NOT NULL, password VARCHAR(100) NOT NULL, UNIQUE INDEX unique_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_client (id INT AUTO_INCREMENT NOT NULL, app_key VARCHAR(50) NOT NULL, app_client VARCHAR(100) NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, id_app_client INT DEFAULT NULL, id_login INT DEFAULT NULL, access_token VARCHAR(255) DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT NULL, expires_in DATETIME DEFAULT NULL, INDEX IDX_5F37A13B87CDE902 (id_app_client), INDEX IDX_5F37A13B448D8A20 (id_login), INDEX idx_token (access_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(40) NOT NULL, email VARCHAR(40) NOT NULL, cpf VARCHAR(15) NOT NULL, cell_phone VARCHAR(12) NOT NULL, admin TINYINT(1) DEFAULT \'0\' NOT NULL, date_created DATETIME NOT NULL, INDEX idx_email (email), UNIQUE INDEX unique_cpf (cpf), UNIQUE INDEX unique_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AE6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_account ADD CONSTRAINT FK_253B48AEA3ABFFD4 FOREIGN KEY (id_account) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE login_user ADD CONSTRAINT FK_4BE15D0C448D8A20 FOREIGN KEY (id_login) REFERENCES login (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE login_user ADD CONSTRAINT FK_4BE15D0C6B3CA4B FOREIGN KEY (id_user) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transition ADD CONSTRAINT FK_F715A75AA3ABFFD4 FOREIGN KEY (id_account) REFERENCES account (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transition ADD CONSTRAINT FK_F715A75ADBAA048D FOREIGN KEY (id_transition_type) REFERENCES transition_type (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE transition ADD CONSTRAINT FK_F715A75A14E37FDF FOREIGN KEY (id_transition_category) REFERENCES transition_category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13B87CDE902 FOREIGN KEY (id_app_client) REFERENCES app_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13B448D8A20 FOREIGN KEY (id_login) REFERENCES login (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AEA3ABFFD4');
        $this->addSql('ALTER TABLE transition DROP FOREIGN KEY FK_F715A75AA3ABFFD4');
        $this->addSql('ALTER TABLE transition DROP FOREIGN KEY FK_F715A75ADBAA048D');
        $this->addSql('ALTER TABLE transition DROP FOREIGN KEY FK_F715A75A14E37FDF');
        $this->addSql('ALTER TABLE login_user DROP FOREIGN KEY FK_4BE15D0C448D8A20');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13B448D8A20');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13B87CDE902');
        $this->addSql('ALTER TABLE user_account DROP FOREIGN KEY FK_253B48AE6B3CA4B');
        $this->addSql('ALTER TABLE login_user DROP FOREIGN KEY FK_4BE15D0C6B3CA4B');
        $this->addSql('DROP TABLE user_account');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE transition_type');
        $this->addSql('DROP TABLE login_user');
        $this->addSql('DROP TABLE transition_category');
        $this->addSql('DROP TABLE transition');
        $this->addSql('DROP TABLE login');
        $this->addSql('DROP TABLE app_client');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE user');
    }
}
