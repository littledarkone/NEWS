<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190422151030 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adm_visits ADD obsid INT NOT NULL');
        $this->addSql('ALTER TABLE observations DROP FOREIGN KEY FK_observations_adm_visits');
        $this->addSql('DROP INDEX FK_observations_adm_visits ON observations');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adm_visits DROP obsid');
        $this->addSql('ALTER TABLE observations ADD CONSTRAINT FK_observations_adm_visits FOREIGN KEY (patientid) REFERENCES adm_visits (id)');
        $this->addSql('CREATE INDEX FK_observations_adm_visits ON observations (patientid)');
    }
}
