<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201123133641 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE center_interest (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_287F852A216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE certificate (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_219CDA4A216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_information (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, adresse VARCHAR(255) NOT NULL, numero INT NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_47D5A73D216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cv (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_B66FFE9279F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infos_perso (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, firstname VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, jobtitle VARCHAR(255) NOT NULL, INDEX IDX_F29A1A03216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professional_course (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, period VARCHAR(255) NOT NULL, skillsacquired VARCHAR(255) NOT NULL, INDEX IDX_56201D65216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_D5311670216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE training (id INT AUTO_INCREMENT NOT NULL, id_cv_id INT DEFAULT NULL, diplomatitle VARCHAR(255) NOT NULL, school VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, yearofgraduation INT NOT NULL, INDEX IDX_D5128A8F216158D2 (id_cv_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE center_interest ADD CONSTRAINT FK_287F852A216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4A216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE contact_information ADD CONSTRAINT FK_47D5A73D216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE cv ADD CONSTRAINT FK_B66FFE9279F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE infos_perso ADD CONSTRAINT FK_F29A1A03216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE professional_course ADD CONSTRAINT FK_56201D65216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE skills ADD CONSTRAINT FK_D5311670216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
        $this->addSql('ALTER TABLE training ADD CONSTRAINT FK_D5128A8F216158D2 FOREIGN KEY (id_cv_id) REFERENCES cv (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE center_interest DROP FOREIGN KEY FK_287F852A216158D2');
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4A216158D2');
        $this->addSql('ALTER TABLE contact_information DROP FOREIGN KEY FK_47D5A73D216158D2');
        $this->addSql('ALTER TABLE infos_perso DROP FOREIGN KEY FK_F29A1A03216158D2');
        $this->addSql('ALTER TABLE professional_course DROP FOREIGN KEY FK_56201D65216158D2');
        $this->addSql('ALTER TABLE skills DROP FOREIGN KEY FK_D5311670216158D2');
        $this->addSql('ALTER TABLE training DROP FOREIGN KEY FK_D5128A8F216158D2');
        $this->addSql('DROP TABLE center_interest');
        $this->addSql('DROP TABLE certificate');
        $this->addSql('DROP TABLE contact_information');
        $this->addSql('DROP TABLE cv');
        $this->addSql('DROP TABLE infos_perso');
        $this->addSql('DROP TABLE professional_course');
        $this->addSql('DROP TABLE skills');
        $this->addSql('DROP TABLE training');
    }
}
