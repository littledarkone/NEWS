<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426181103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adm_visits DROP FOREIGN KEY FK_adm_visits_providers');
        $this->addSql('DROP INDEX FK_adm_visits_providers ON adm_visits');
        $this->addSql('ALTER TABLE adm_visits CHANGE provider_id provider_id INT NOT NULL');
        $this->addSql('ALTER TABLE login DROP FOREIGN KEY FK_login_providers');
        $this->addSql('DROP INDEX FK_login_providers ON login');
        $this->addSql('ALTER TABLE observations DROP FOREIGN KEY FK_observations_adm_visits');
        $this->addSql('DROP INDEX FK_observations_adm_visits ON observations');
        $this->addSql('ALTER TABLE providers ADD mnemonic VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adm_visits CHANGE provider_id provider_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adm_visits ADD CONSTRAINT FK_adm_visits_providers FOREIGN KEY (provider_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX FK_adm_visits_providers ON adm_visits (provider_id)');
        $this->addSql('ALTER TABLE login ADD CONSTRAINT FK_login_providers FOREIGN KEY (provider_id) REFERENCES providers (id)');
        $this->addSql('CREATE INDEX FK_login_providers ON login (provider_id)');
        $this->addSql('ALTER TABLE observations ADD CONSTRAINT FK_observations_adm_visits FOREIGN KEY (patientid) REFERENCES adm_visits (id)');
        $this->addSql('CREATE INDEX FK_observations_adm_visits ON observations (patientid)');
        $this->addSql('ALTER TABLE providers DROP mnemonic');
    }
}
