<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025134703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3A6E44244');
        $this->addSql('DROP INDEX IDX_2D3343C3A6E44244 ON destinations');
        $this->addSql('ALTER TABLE destinations DROP pays_id');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955816C6140');
        $this->addSql('DROP INDEX IDX_3F9D8955816C6140 ON voyage');
        $this->addSql('ALTER TABLE voyage DROP created_at, CHANGE description description VARCHAR(255) NOT NULL, CHANGE texte texte LONGTEXT NOT NULL, CHANGE destination_id voyage_id INT NOT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895568C9E5AF FOREIGN KEY (voyage_id) REFERENCES destinations (id)');
        $this->addSql('CREATE INDEX IDX_3F9D895568C9E5AF ON voyage (voyage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE destinations ADD pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_2D3343C3A6E44244 ON destinations (pays_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895568C9E5AF');
        $this->addSql('DROP INDEX IDX_3F9D895568C9E5AF ON voyage');
        $this->addSql('ALTER TABLE voyage ADD created_at DATETIME NOT NULL, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE texte texte LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE voyage_id destination_id INT NOT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955816C6140 FOREIGN KEY (destination_id) REFERENCES destinations (id)');
        $this->addSql('CREATE INDEX IDX_3F9D8955816C6140 ON voyage (destination_id)');
    }
}
