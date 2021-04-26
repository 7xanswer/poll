<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210426201226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer CHANGE question_id question_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE result DROP INDEX UNIQ_136AC113AA334807, ADD INDEX IDX_136AC113AA334807 (answer_id)');
        $this->addSql('ALTER TABLE result CHANGE answer_id answer_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer CHANGE question_id question_id INT NOT NULL');
        $this->addSql('ALTER TABLE result DROP INDEX IDX_136AC113AA334807, ADD UNIQUE INDEX UNIQ_136AC113AA334807 (answer_id)');
        $this->addSql('ALTER TABLE result CHANGE answer_id answer_id INT NOT NULL');
    }
}
