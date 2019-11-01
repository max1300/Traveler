<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191101160755 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE destinations (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, ville VARCHAR(255) NOT NULL, lat VARCHAR(255) NOT NULL, lng VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_2D3343C3A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE photo (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, nom VARCHAR(255) NOT NULL, file_path VARCHAR(255) NOT NULL, legende VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_14B7841868C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_8D93D649AA08CB10 (login), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, voyage_id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, texte LONGTEXT NOT NULL, INDEX IDX_3F9D895568C9E5AF (voyage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE destinations ADD CONSTRAINT FK_2D3343C3A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841868C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895568C9E5AF FOREIGN KEY (voyage_id) REFERENCES destinations (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895568C9E5AF');
        $this->addSql('ALTER TABLE destinations DROP FOREIGN KEY FK_2D3343C3A6E44244');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841868C9E5AF');
        $this->addSql('DROP TABLE destinations');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE photo');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE voyage');
    }
}
