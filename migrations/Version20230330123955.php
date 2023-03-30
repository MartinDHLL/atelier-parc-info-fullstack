<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230330123955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE659321088B');
        $this->addSql('DROP INDEX IDX_3D8EE659321088B ON ticket_action');
        $this->addSql('ALTER TABLE ticket_action ADD issue_id INT NOT NULL, DROP issues_id');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE6595E7AA58C FOREIGN KEY (issue_id) REFERENCES issue (id)');
        $this->addSql('CREATE INDEX IDX_3D8EE6595E7AA58C ON ticket_action (issue_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket_action DROP FOREIGN KEY FK_3D8EE6595E7AA58C');
        $this->addSql('DROP INDEX IDX_3D8EE6595E7AA58C ON ticket_action');
        $this->addSql('ALTER TABLE ticket_action ADD issues_id INT DEFAULT NULL, DROP issue_id');
        $this->addSql('ALTER TABLE ticket_action ADD CONSTRAINT FK_3D8EE659321088B FOREIGN KEY (issues_id) REFERENCES issue (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3D8EE659321088B ON ticket_action (issues_id)');
    }
}
