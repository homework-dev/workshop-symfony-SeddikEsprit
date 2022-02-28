<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220221082448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD92BC77');
        $this->addSql('DROP INDEX IDX_E9E2810FD92BC77 ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE voiture_relation_id voiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F181A8BA FOREIGN KEY (voiture_id) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F181A8BA ON voiture (voiture_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chauffeur CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F181A8BA');
        $this->addSql('DROP INDEX IDX_E9E2810F181A8BA ON voiture');
        $this->addSql('ALTER TABLE voiture CHANGE marque marque VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE voiture_id voiture_relation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD92BC77 FOREIGN KEY (voiture_relation_id) REFERENCES chauffeur (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FD92BC77 ON voiture (voiture_relation_id)');
    }
}
