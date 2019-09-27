<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190927112851 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(26) NOT NULL, ADD lastname VARCHAR(16) NOT NULL, ADD gender enum(\'masculin\', \'eminin\'), ADD phone VARCHAR(16) DEFAULT NULL, ADD address VARCHAR(100) NOT NULL, DROP nom, DROP prenom, CHANGE date_naissance birthdate DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD prenom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP firstname, DROP lastname, DROP phone, DROP address, CHANGE gender nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE birthdate date_naissance DATETIME DEFAULT NULL');
    }
}
