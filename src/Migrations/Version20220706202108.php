<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220706202108 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__api_key AS SELECT id, email, "key", created, opt_in_date FROM api_key');
        $this->addSql('DROP TABLE api_key');
        $this->addSql('CREATE TABLE api_key (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, "key" VARCHAR(64) NOT NULL, created DATETIME NOT NULL, opt_in_date DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO api_key (id, email, "key", created, opt_in_date) SELECT id, email, "key", created, opt_in_date FROM __temp__api_key');
        $this->addSql('DROP TABLE __temp__api_key');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__api_key AS SELECT id, email, "key", created, opt_in_date FROM api_key');
        $this->addSql('DROP TABLE api_key');
        $this->addSql('CREATE TABLE api_key (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, "key" VARCHAR(64) NOT NULL, created DATETIME NOT NULL, opt_in_date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO api_key (id, email, "key", created, opt_in_date) SELECT id, email, "key", created, opt_in_date FROM __temp__api_key');
        $this->addSql('DROP TABLE __temp__api_key');
    }
}
