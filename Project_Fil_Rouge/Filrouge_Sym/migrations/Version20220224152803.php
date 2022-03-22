<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220224152803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categories CHANGE nom_cat nom_cat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_cat image_cat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE clients CHANGE nom_client nom_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom_client prenom_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress_client adress_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville_client ville_client VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type_client type_client VARCHAR(3) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commandes CHANGE adress_livr adress_livr VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville_livr ville_livr VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress_fact adress_fact VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville_fact ville_fact VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE fournisseurs CHANGE nom_four nom_four VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom_four prenom_four VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE adress_four adress_four VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ville_four ville_four VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type_four type_four VARCHAR(3) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE produits CHANGE num_article num_article VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE libelle_courte_article libelle_courte_article VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE libelle_long_article libelle_long_article VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_article image_article VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE se_compose_de CHANGE type_paiement type_paiement VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE sous_categories CHANGE num_souscat num_souscat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom_souscat nom_souscat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_souscat image_souscat VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
