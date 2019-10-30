<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191025082423 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE destinations (id INT AUTO_INCREMENT NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, lat VARCHAR(255) NOT NULL, lng VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_14B7841868C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, destination_id INT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, description VARCHAR(255) DEFAULT NULL, texte LONGTEXT DEFAULT NULL, INDEX IDX_3F9D8955816C6140 (destination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841868C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955816C6140 FOREIGN KEY (destination_id) REFERENCES destinations (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955816C6140');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841868C9E5AF');
        $this->addSql('DROP TABLE destinations');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE voyage');
    }
}
