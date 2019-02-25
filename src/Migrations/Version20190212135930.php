<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212135930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookings CHANGE status status INT (7) DEFAULT NULL');
        $this->addSql('ALTER TABLE bookings CHANGE period period INT (7) DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant DROP reservation_date, DROP period, DROP reserved');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookings CHANGE status status INT (7) NOT NULL');
        $this->addSql('ALTER TABLE bookings CHANGE status status INT (7) NOT NULL');
        $this->addSql('ALTER TABLE restaurant ADD reservation_date DATE DEFAULT NULL, ADD period TINYINT(1) DEFAULT NULL, ADD reserved TINYINT(1) DEFAULT NULL');
    }
}
