<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190505231858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE books (tags INT DEFAULT NULL, id INT AUTO_INCREMENT NOT NULL, name TEXT NOT NULL COLLATE utf8mb4_general_ci, poster TEXT NOT NULL COLLATE utf8mb4_general_ci, link TEXT NOT NULL COLLATE utf8mb4_general_ci, price DOUBLE PRECISION NOT NULL, tags_name VARCHAR(256) DEFAULT NULL COLLATE utf8mb4_general_ci, date DATE DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL, author TEXT DEFAULT NULL COLLATE utf8mb4_general_ci, info TEXT DEFAULT NULL COLLATE utf8mb4_general_ci, INDEX tags (tags), UNIQUE INDEX id (id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tags (tags_id INT AUTO_INCREMENT NOT NULL, tag_name VARCHAR(64) DEFAULT NULL COLLATE utf8mb4_general_ci, UNIQUE INDEX tags_id_2 (tags_id), INDEX tags_id (tags_id), PRIMARY KEY(tags_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE books');
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tags');
    }
}
