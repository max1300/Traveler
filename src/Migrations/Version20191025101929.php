<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025101929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations ADD pays_id INT NOT NULL, ADD created_at DATETIME NOT NULL, DROP pays');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_2D3343C3A6E44244 ON destinations (pays_id)');
        $this->addSql('ALTER TABLE user ADD created_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3A6E44244');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP INDEX IDX_2D3343C3A6E44244 ON destinations');
        $this->addSql('ALTER TABLE destinations ADD pays VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, DROP pays_id, DROP created_at');
        $this->addSql('ALTER TABLE user DROP created_at');
    }
}
