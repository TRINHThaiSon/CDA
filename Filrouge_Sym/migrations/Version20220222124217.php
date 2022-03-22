<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220222124217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom_cat VARCHAR(255) NOT NULL, image_cat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, nom_client VARCHAR(255) NOT NULL, prenom_client VARCHAR(255) NOT NULL, adress_client VARCHAR(255) NOT NULL, cp_client VARCHAR(10) NOT NULL, ville_client INT NOT NULL, contact_client INT NOT NULL, type_client VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, date_comm DATETIME NOT NULL, montant_comm DOUBLE PRECISION NOT NULL, adress_livr VARCHAR(255) NOT NULL, cp_livr INT NOT NULL, ville_livr VARCHAR(255) NOT NULL, adress_fact VARCHAR(255) NOT NULL, cp_fact INT NOT NULL, ville_fact VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facturation (id INT AUTO_INCREMENT NOT NULL, date_fact DATE NOT NULL, coef_deduit DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseurs (id INT AUTO_INCREMENT NOT NULL, nom_four VARCHAR(255) NOT NULL, prenom_four VARCHAR(255) NOT NULL, adress_four VARCHAR(255) NOT NULL, cp_four INT NOT NULL, ville_four VARCHAR(255) NOT NULL, contact_four INT NOT NULL, type_four VARCHAR(3) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournit (id INT AUTO_INCREMENT NOT NULL, prix_unit_fou DOUBLE PRECISION NOT NULL, taux_tvafou DOUBLE PRECISION NOT NULL, qte_fou INT NOT NULL, date_fou DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraisons (id INT AUTO_INCREMENT NOT NULL, date_livraison DATE NOT NULL, date_arr_prevue DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, num_article VARCHAR(255) NOT NULL, libelle_courte_article VARCHAR(255) NOT NULL, libelle_long_article VARCHAR(255) DEFAULT NULL, image_article VARCHAR(255) NOT NULL, prixunit_article DOUBLE PRECISION NOT NULL, nombre_stk_article INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE se_compose_de (id INT AUTO_INCREMENT NOT NULL, qte_article_comm INT NOT NULL, taux_tva DOUBLE PRECISION NOT NULL, type_paiement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categories (id INT AUTO_INCREMENT NOT NULL, num_souscat VARCHAR(255) NOT NULL, nom_souscat VARCHAR(255) NOT NULL, image_souscat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE facturation');
        $this->addSql('DROP TABLE fournisseurs');
        $this->addSql('DROP TABLE fournit');
        $this->addSql('DROP TABLE livraisons');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE se_compose_de');
        $this->addSql('DROP TABLE sous_categories');
    }
}
