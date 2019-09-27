<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926144128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vacation_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vacation_type_id INT NOT NULL, request_status_id INT NOT NULL, user_comment LONGTEXT DEFAULT NULL, manager_comment LONGTEXT DEFAULT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2A3500FCA76ED395 (user_id), INDEX IDX_2A3500FCD4EE03F0 (vacation_type_id), INDEX IDX_2A3500FC2006F11A (request_status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE request_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE main_function (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, shortcut VARCHAR(8) DEFAULT NULL, description LONGTEXT DEFAULT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(16) NOT NULL, shortcut VARCHAR(8) DEFAULT NULL, description LONGTEXT DEFAULT NULL, basic_value INT NOT NULL, max_allowed INT NOT NULL, enabled TINYINT(1) DEFAULT \'1\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entity (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(16) NOT NULL, shortcut VARCHAR(8) DEFAULT NULL, description LONGTEXT DEFAULT NULL, start_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, closed_at DATETIME NOT NULL, INDEX IDX_E284468727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contract (id INT AUTO_INCREMENT NOT NULL, contract_type_id INT NOT NULL, user_id INT NOT NULL, start_at DATETIME NOT NULL, end_at DATETIME NOT NULL, enabled TINYINT(1) DEFAULT \'0\' NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E98F2859CD1DF15B (contract_type_id), INDEX IDX_E98F2859A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, vacation_type_id INT NOT NULL, birthdate DATE NOT NULL, win DOUBLE PRECISION DEFAULT \'0\' NOT NULL, spent DOUBLE PRECISION DEFAULT \'0\' NOT NULL, start_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_E3DADF75A76ED395 (user_id), INDEX IDX_E3DADF75D4EE03F0 (vacation_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE vacation_request ADD CONSTRAINT FK_2A3500FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vacation_request ADD CONSTRAINT FK_2A3500FCD4EE03F0 FOREIGN KEY (vacation_type_id) REFERENCES vacation_type (id)');
        $this->addSql('ALTER TABLE vacation_request ADD CONSTRAINT FK_2A3500FC2006F11A FOREIGN KEY (request_status_id) REFERENCES request_status (id)');
        $this->addSql('ALTER TABLE entity ADD CONSTRAINT FK_E284468727ACA70 FOREIGN KEY (parent_id) REFERENCES entity (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859CD1DF15B FOREIGN KEY (contract_type_id) REFERENCES contract_type (id)');
        $this->addSql('ALTER TABLE contract ADD CONSTRAINT FK_E98F2859A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vacation ADD CONSTRAINT FK_E3DADF75A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vacation ADD CONSTRAINT FK_E3DADF75D4EE03F0 FOREIGN KEY (vacation_type_id) REFERENCES vacation_type (id)');
        $this->addSql('ALTER TABLE user ADD mainfunction_id INT DEFAULT NULL, ADD entity_id INT NOT NULL, ADD date_naissance DATETIME DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6493CB70C1A FOREIGN KEY (mainfunction_id) REFERENCES main_function (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64981257D5D FOREIGN KEY (entity_id) REFERENCES entity (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6493CB70C1A ON user (mainfunction_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64981257D5D ON user (entity_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vacation_request DROP FOREIGN KEY FK_2A3500FC2006F11A');
        $this->addSql('ALTER TABLE contract DROP FOREIGN KEY FK_E98F2859CD1DF15B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6493CB70C1A');
        $this->addSql('ALTER TABLE vacation_request DROP FOREIGN KEY FK_2A3500FCD4EE03F0');
        $this->addSql('ALTER TABLE vacation DROP FOREIGN KEY FK_E3DADF75D4EE03F0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64981257D5D');
        $this->addSql('ALTER TABLE entity DROP FOREIGN KEY FK_E284468727ACA70');
        $this->addSql('DROP TABLE vacation_request');
        $this->addSql('DROP TABLE request_status');
        $this->addSql('DROP TABLE contract_type');
        $this->addSql('DROP TABLE main_function');
        $this->addSql('DROP TABLE vacation_type');
        $this->addSql('DROP TABLE entity');
        $this->addSql('DROP TABLE contract');
        $this->addSql('DROP TABLE vacation');
        $this->addSql('DROP INDEX IDX_8D93D6493CB70C1A ON user');
        $this->addSql('DROP INDEX IDX_8D93D64981257D5D ON user');
        $this->addSql('ALTER TABLE user DROP mainfunction_id, DROP entity_id, DROP date_naissance, DROP created_at, DROP updated_at');
    }
}
