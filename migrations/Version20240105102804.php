<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105102804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D19FA60E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hardware (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT DEFAULT NULL, type_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, serial_num VARCHAR(255) NOT NULL, INDEX IDX_FE99E9E0A4AEAFEA (entreprise_id), INDEX IDX_FE99E9E0C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE solution (id INT AUTO_INCREMENT NOT NULL, issue_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_9F3329DB5E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, hardware_id INT DEFAULT NULL, number INT DEFAULT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_97A0ADA3C9CC762B (hardware_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_action (id INT AUTO_INCREMENT NOT NULL, ticket_id INT DEFAULT NULL, user_id INT DEFAULT NULL, statut_id INT NOT NULL, issue_id INT NOT NULL, intitule VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, temps INT NOT NULL, priorite INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3D8EE659700047D2 (ticket_id), INDEX IDX_3D8EE659A76ED395 (user_id), INDEX IDX_3D8EE659F6203804 (statut_id), INDEX IDX_3D8EE6595E7AA58C (issue_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, code INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hardware ADD CONSTRAINT FK_FE99E9E0A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE hardware ADD CONSTRAINT FK_FE99E9E0C54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE solution ADD CONSTRAINT FK_9F3329DB5E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3C9CC762B FOREIGN KEY (hardware_id) REFERENCES hardware (id)');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE659700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE659A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE659F6203804 FOREIGN KEY (statut_id) REFERENCES statut (id)');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE6595E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hardware DROP FOREIGN KEY FK_FE99E9E0A4AEAFEA');
        $this->addSql('ALTER TABLE hardware DROP FOREIGN KEY FK_FE99E9E0C54C8C93');
        $this->addSql('ALTER TABLE solution DROP FOREIGN KEY FK_9F3329DB5E7AA58C');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3C9CC762B');
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE659700047D2');
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE659A76ED395');
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE659F6203804');
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE6595E7AA58C');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE hardware');
        $this->addSql('DROP TABLE issue');
        $this->addSql('DROP TABLE solution');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE ticket_action');
        $this->addSql('DROP TABLE type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
