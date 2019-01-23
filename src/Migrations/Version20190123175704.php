<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123175704 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurant CHANGE hall_1 hall_1 VARCHAR(255) NOT NULL, CHANGE hall_2 hall_2 VARCHAR(255) NOT NULL, CHANGE active active TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE user CHANGE role role LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE restaurant CHANGE hall_1 hall_1 INT NOT NULL, CHANGE hall_2 hall_2 INT NOT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE role role LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
