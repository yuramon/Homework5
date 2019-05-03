<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190503110207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE books (id INT NOT NULL, name TEXT NOT NULL COLLATE utf8mb4_general_ci, poster TEXT NOT NULL COLLATE utf8mb4_general_ci, link TEXT NOT NULL COLLATE utf8mb4_general_ci, price DOUBLE PRECISION NOT NULL, tags TEXT NOT NULL COLLATE utf8mb4_general_ci, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, author TEXT NOT NULL COLLATE utf8mb4_general_ci, info TEXT NOT NULL COLLATE utf8mb4_general_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE books');
    }
}
