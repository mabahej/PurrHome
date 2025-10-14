<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251009120325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE vitrine_chat (vitrine_id INTEGER NOT NULL, chat_id INTEGER NOT NULL, PRIMARY KEY(vitrine_id, chat_id), CONSTRAINT FK_842E31A27F17893 FOREIGN KEY (vitrine_id) REFERENCES vitrine (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_842E31A1A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_842E31A27F17893 ON vitrine_chat (vitrine_id)');
        $this->addSql('CREATE INDEX IDX_842E31A1A9A7125 ON vitrine_chat (chat_id)');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vitrine AS SELECT id, chat_id, photo_url, description FROM vitrine');
        $this->addSql('DROP TABLE vitrine');
        $this->addSql('CREATE TABLE vitrine (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, createur_id INTEGER NOT NULL, photo_url VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, publiee BOOLEAN NOT NULL, CONSTRAINT FK_71EB69B41A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_71EB69B473A201E5 FOREIGN KEY (createur_id) REFERENCES member (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vitrine (id, chat_id, photo_url, description) SELECT id, chat_id, photo_url, description FROM __temp__vitrine');
        $this->addSql('DROP TABLE __temp__vitrine');
        $this->addSql('CREATE INDEX IDX_71EB69B41A9A7125 ON vitrine (chat_id)');
        $this->addSql('CREATE INDEX IDX_71EB69B473A201E5 ON vitrine (createur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) NOT NULL COLLATE "BINARY", prenom VARCHAR(255) DEFAULT NULL COLLATE "BINARY", email VARCHAR(255) NOT NULL COLLATE "BINARY", role VARCHAR(255) DEFAULT NULL COLLATE "BINARY")');
        $this->addSql('DROP TABLE vitrine_chat');
        $this->addSql('CREATE TEMPORARY TABLE __temp__vitrine AS SELECT id, chat_id, photo_url, description FROM vitrine');
        $this->addSql('DROP TABLE vitrine');
        $this->addSql('CREATE TABLE vitrine (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, chat_id INTEGER NOT NULL, photo_url VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, CONSTRAINT FK_71EB69B41A9A7125 FOREIGN KEY (chat_id) REFERENCES chat (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO vitrine (id, chat_id, photo_url, description) SELECT id, chat_id, photo_url, description FROM __temp__vitrine');
        $this->addSql('DROP TABLE __temp__vitrine');
        $this->addSql('CREATE INDEX IDX_71EB69B41A9A7125 ON vitrine (chat_id)');
    }
}
