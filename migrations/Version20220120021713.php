<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120021713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bras_spiral (id INT AUTO_INCREMENT NOT NULL, galaxie_id INT NOT NULL, nom VARCHAR(20) NOT NULL, longueur INT NOT NULL, largeur INT NOT NULL, description VARCHAR(50) DEFAULT NULL, INDEX IDX_7004BDF8D78791BE (galaxie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etoile (id INT AUTO_INCREMENT NOT NULL, systeme_planetaire_id INT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, description VARCHAR(50) DEFAULT NULL, gravite DOUBLE PRECISION NOT NULL, INDEX IDX_357ADFC36871D527 (systeme_planetaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE galaxie (id INT AUTO_INCREMENT NOT NULL, groupe_galaxies_id INT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, diametre INT NOT NULL, INDEX IDX_1C88071144A2D7F1 (groupe_galaxies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_galaxies (id INT AUTO_INCREMENT NOT NULL, superamas_id INT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, INDEX IDX_E0006C8E74CFAA3C (superamas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planete (id INT AUTO_INCREMENT NOT NULL, etoile_id INT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, gravite DOUBLE PRECISION NOT NULL, description VARCHAR(50) NOT NULL, INDEX IDX_490E3E5743D8ACEE (etoile_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE satellite (id INT AUTO_INCREMENT NOT NULL, planete_id INT NOT NULL, nom VARCHAR(20) NOT NULL, diametre INT NOT NULL, gravite DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, INDEX IDX_6FC72A37A9CFCB36 (planete_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superamas (id INT AUTO_INCREMENT NOT NULL, superamas_galaxies_id INT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, INDEX IDX_8AAB3B52EC0A65FD (superamas_galaxies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE superamas_galaxies (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) NOT NULL, taille DOUBLE PRECISION NOT NULL, description VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE systeme_planetaire (id INT AUTO_INCREMENT NOT NULL, bras_spiral_id INT NOT NULL, nom VARCHAR(50) NOT NULL, description VARCHAR(50) DEFAULT NULL, INDEX IDX_1A9F4B4A8B90F3C4 (bras_spiral_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bras_spiral ADD CONSTRAINT FK_7004BDF8D78791BE FOREIGN KEY (galaxie_id) REFERENCES galaxie (id)');
        $this->addSql('ALTER TABLE etoile ADD CONSTRAINT FK_357ADFC36871D527 FOREIGN KEY (systeme_planetaire_id) REFERENCES systeme_planetaire (id)');
        $this->addSql('ALTER TABLE galaxie ADD CONSTRAINT FK_1C88071144A2D7F1 FOREIGN KEY (groupe_galaxies_id) REFERENCES groupe_galaxies (id)');
        $this->addSql('ALTER TABLE groupe_galaxies ADD CONSTRAINT FK_E0006C8E74CFAA3C FOREIGN KEY (superamas_id) REFERENCES superamas (id)');
        $this->addSql('ALTER TABLE planete ADD CONSTRAINT FK_490E3E5743D8ACEE FOREIGN KEY (etoile_id) REFERENCES etoile (id)');
        $this->addSql('ALTER TABLE satellite ADD CONSTRAINT FK_6FC72A37A9CFCB36 FOREIGN KEY (planete_id) REFERENCES planete (id)');
        $this->addSql('ALTER TABLE superamas ADD CONSTRAINT FK_8AAB3B52EC0A65FD FOREIGN KEY (superamas_galaxies_id) REFERENCES superamas_galaxies (id)');
        $this->addSql('ALTER TABLE systeme_planetaire ADD CONSTRAINT FK_1A9F4B4A8B90F3C4 FOREIGN KEY (bras_spiral_id) REFERENCES bras_spiral (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE systeme_planetaire DROP FOREIGN KEY FK_1A9F4B4A8B90F3C4');
        $this->addSql('ALTER TABLE planete DROP FOREIGN KEY FK_490E3E5743D8ACEE');
        $this->addSql('ALTER TABLE bras_spiral DROP FOREIGN KEY FK_7004BDF8D78791BE');
        $this->addSql('ALTER TABLE galaxie DROP FOREIGN KEY FK_1C88071144A2D7F1');
        $this->addSql('ALTER TABLE satellite DROP FOREIGN KEY FK_6FC72A37A9CFCB36');
        $this->addSql('ALTER TABLE groupe_galaxies DROP FOREIGN KEY FK_E0006C8E74CFAA3C');
        $this->addSql('ALTER TABLE superamas DROP FOREIGN KEY FK_8AAB3B52EC0A65FD');
        $this->addSql('ALTER TABLE etoile DROP FOREIGN KEY FK_357ADFC36871D527');
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
