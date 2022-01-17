<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220117133549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bras_spiral (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, longueur INT NOT NULL, largeur INT NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etoile (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galaxie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, diametre INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_galaxies (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planete (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, gravite DOUBLE PRECISION NOT NULL, description VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE satellite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, gravite DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superamas (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superamas_galaxies (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE systeme_planetaire (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bras_spiral');
        $this->addSql('DROP TABLE etoile');
        $this->addSql('DROP TABLE galaxie');
        $this->addSql('DROP TABLE groupe_galaxies');
        $this->addSql('DROP TABLE planete');
        $this->addSql('DROP TABLE satellite');
        $this->addSql('DROP TABLE superamas');
        $this->addSql('DROP TABLE superamas_galaxies');
        $this->addSql('DROP TABLE systeme_planetaire');
    }
}
