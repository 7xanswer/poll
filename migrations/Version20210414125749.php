<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414125749 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE result ADD answer_id INT NOT NULL, ADD user_id INT DEFAULT NULL, ADD ip VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id)');
        $this->addSql('ALTER TABLE result ADD CONSTRAINT FK_136AC113A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_136AC113AA334807 ON result (answer_id)');
        $this->addSql('CREATE INDEX IDX_136AC113A76ED395 ON result (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC113AA334807');
        $this->addSql('ALTER TABLE result DROP FOREIGN KEY FK_136AC113A76ED395');
        $this->addSql('DROP INDEX UNIQ_136AC113AA334807 ON result');
        $this->addSql('DROP INDEX IDX_136AC113A76ED395 ON result');
        $this->addSql('ALTER TABLE result DROP answer_id, DROP user_id, DROP ip');
    }
}
