<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210228013722 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE evento_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE inscricao_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pessoa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE evento (id INT NOT NULL, nome VARCHAR(200) NOT NULL, descricao VARCHAR(255) DEFAULT NULL, data_inicio TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, data_fim TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, cidade VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE inscricao (id INT NOT NULL, evento_id INT NOT NULL, pessoa_id INT NOT NULL, data_inscricao TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, identificador_unico VARCHAR(100) NOT NULL, ativo BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AE0E7EEA87A5F842 ON inscricao (evento_id)');
        $this->addSql('CREATE INDEX IDX_AE0E7EEADF6FA0A5 ON inscricao (pessoa_id)');
        $this->addSql('CREATE TABLE pessoa (id INT NOT NULL, nome VARCHAR(100) NOT NULL, data_nascimento DATE NOT NULL, telefone VARCHAR(18) DEFAULT NULL, email VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1CDFAB82E7927C74 ON pessoa (email)');
        $this->addSql('ALTER TABLE inscricao ADD CONSTRAINT FK_AE0E7EEA87A5F842 FOREIGN KEY (evento_id) REFERENCES evento (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE inscricao ADD CONSTRAINT FK_AE0E7EEADF6FA0A5 FOREIGN KEY (pessoa_id) REFERENCES pessoa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE inscricao DROP CONSTRAINT FK_AE0E7EEA87A5F842');
        $this->addSql('ALTER TABLE inscricao DROP CONSTRAINT FK_AE0E7EEADF6FA0A5');
        $this->addSql('DROP SEQUENCE evento_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE inscricao_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pessoa_id_seq CASCADE');
        $this->addSql('DROP TABLE evento');
        $this->addSql('DROP TABLE inscricao');
        $this->addSql('DROP TABLE pessoa');
    }
}
