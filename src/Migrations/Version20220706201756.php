<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220706201756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE api_key ADD COLUMN created DATETIME NOT NULL');
        $this->addSql('ALTER TABLE api_key ADD COLUMN opt_in_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE reminder ADD COLUMN created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TEMPORARY TABLE __temp__api_key AS SELECT id, email, "key" FROM api_key');
        $this->addSql('DROP TABLE api_key');
        $this->addSql('CREATE TABLE api_key (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, "key" VARCHAR(64) NOT NULL)');
        $this->addSql('INSERT INTO api_key (id, email, "key") SELECT id, email, "key" FROM __temp__api_key');
        $this->addSql('DROP TABLE __temp__api_key');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reminder AS SELECT id, email FROM reminder');
        $this->addSql('DROP TABLE reminder');
        $this->addSql('CREATE TABLE reminder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO reminder (id, email) SELECT id, email FROM __temp__reminder');
        $this->addSql('DROP TABLE __temp__reminder');
    }
}
