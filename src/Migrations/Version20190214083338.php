<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190214083338 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_notifications ADD restaurantId INT DEFAULT NULL, DROP restaurant_id');
        $this->addSql('ALTER TABLE user_notifications ADD CONSTRAINT FK_8E8E1D8381DAF313 FOREIGN KEY (restaurantId) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_8E8E1D8381DAF313 ON user_notifications (restaurantId)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_notifications DROP FOREIGN KEY FK_8E8E1D8381DAF313');
        $this->addSql('DROP INDEX IDX_8E8E1D8381DAF313 ON user_notifications');
        $this->addSql('ALTER TABLE user_notifications ADD restaurant_id INT NOT NULL, DROP restaurantId');
    }
}
