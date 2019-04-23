<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422135705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE observations (id INT AUTO_INCREMENT NOT NULL, bp INT NOT NULL, pulse INT NOT NULL, respirations INT NOT NULL, sp_o2 INT NOT NULL, temperature NUMERIC(3, 1) NOT NULL, level_of_consciousness VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP INDEX FK_adm_visits_providers ON adm_visits');
        $this->addSql('DROP INDEX FK_login_providers ON login');
        $this->addSql('ALTER TABLE providers ADD provider_id INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE observations');
        $this->addSql('CREATE INDEX FK_adm_visits_providers ON adm_visits (provider_id)');
        $this->addSql('CREATE INDEX FK_login_providers ON login (provider_id)');
        $this->addSql('ALTER TABLE providers DROP provider_id');
    }
}
