<?php

declare(strict_types=1);

namespace App\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220701113819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE api_key (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL, "key" VARCHAR(64) NOT NULL)');
        $this->addSql('CREATE TABLE reminder (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE api_key');
        $this->addSql('DROP TABLE reminder');
    }
}
