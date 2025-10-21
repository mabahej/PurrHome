<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251018233933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chat (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_refuge_id INTEGER NOT NULL, nom VARCHAR(255) NOT NULL, age INTEGER DEFAULT NULL, race VARCHAR(255) DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, etat_sante VARCHAR(255) DEFAULT NULL, statut VARCHAR(255) DEFAULT NULL, CONSTRAINT FK_659DF2AA2D01B8E6 FOREIGN KEY (id_refuge_id) REFERENCES refuge (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_659DF2AA2D01B8E6 ON chat (id_refuge_id)');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, refuge_id INTEGER NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, CONSTRAINT FK_70E4FA78AD3404C1 FOREIGN KEY (refuge_id) REFERENCES refuge (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_70E4FA78AD3404C1 ON member (refuge_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON member (email)');
        $this->addSql('CREATE TABLE refuge (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE vitrine (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, createur_id INTEGER NOT NULL, photo_url VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, publiee BOOLEAN NOT NULL, CONSTRAINT FK_71EB69B41A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_71EB69B473A201E5 FOREIGN KEY (createur_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_71EB69B41A9A7125 ON vitrine (chat_id)');
        $this->addSql('CREATE INDEX IDX_71EB69B473A201E5 ON vitrine (createur_id)');
        $this->addSql('CREATE TABLE vitrine_chat (vitrine_id INTEGER NOT NULL, chat_id INTEGER NOT NULL, PRIMARY KEY(vitrine_id, chat_id), CONSTRAINT FK_842E31A27F17893 FOREIGN KEY (vitrine_id) REFERENCES vitrine (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_842E31A1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_842E31A27F17893 ON vitrine_chat (vitrine_id)');
        $this->addSql('CREATE INDEX IDX_842E31A1A9A7125 ON vitrine_chat (chat_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chat');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE refuge');
        $this->addSql('DROP TABLE vitrine');
        $this->addSql('DROP TABLE vitrine_chat');
    }
}
