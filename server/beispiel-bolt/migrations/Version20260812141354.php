<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260812141354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bolt_content (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, content_type VARCHAR(191) NOT NULL, status VARCHAR(191) NOT NULL, created_at DATETIME NOT NULL, modified_at DATETIME DEFAULT NULL, published_at DATETIME DEFAULT NULL, depublished_at DATETIME DEFAULT NULL, title VARCHAR(191) DEFAULT NULL, list_format VARCHAR(191) DEFAULT NULL, author_id INTEGER DEFAULT NULL, CONSTRAINT FK_F5AB2E9CF675F31B FOREIGN KEY (author_id) REFERENCES bolt_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F5AB2E9CF675F31B ON bolt_content (author_id)');
        $this->addSql('CREATE INDEX content_type_idx ON bolt_content (content_type)');
        $this->addSql('CREATE INDEX status_idx ON bolt_content (status)');
        $this->addSql('CREATE TABLE bolt_field (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(191) NOT NULL, sortorder INTEGER NOT NULL, version INTEGER DEFAULT NULL, content_id INTEGER NOT NULL, parent_id INTEGER DEFAULT NULL, type VARCHAR(191) NOT NULL, CONSTRAINT FK_4A2EBBE584A0A3ED FOREIGN KEY (content_id) REFERENCES bolt_content (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4A2EBBE5727ACA70 FOREIGN KEY (parent_id) REFERENCES bolt_field (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_4A2EBBE584A0A3ED ON bolt_field (content_id)');
        $this->addSql('CREATE INDEX IDX_4A2EBBE5727ACA70 ON bolt_field (parent_id)');
        $this->addSql('CREATE TABLE bolt_field_translation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, value CLOB NOT NULL, locale VARCHAR(5) NOT NULL, translatable_id INTEGER DEFAULT NULL, CONSTRAINT FK_5C60C0542C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES bolt_field (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_5C60C0542C2AC5D3 ON bolt_field_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX bolt_field_translation_unique_translation ON bolt_field_translation (translatable_id, locale)');
        $this->addSql('CREATE TABLE bolt_log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, message CLOB NOT NULL, context CLOB DEFAULT NULL, level SMALLINT NOT NULL, level_name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, extra CLOB DEFAULT NULL, "user" CLOB DEFAULT NULL, content INTEGER DEFAULT NULL, location CLOB DEFAULT NULL)');
        $this->addSql('CREATE TABLE bolt_media (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, location VARCHAR(191) NOT NULL, path CLOB NOT NULL, filename VARCHAR(191) NOT NULL, type VARCHAR(191) NOT NULL, width INTEGER DEFAULT NULL, height INTEGER DEFAULT NULL, filesize INTEGER DEFAULT NULL, crop_x INTEGER DEFAULT NULL, crop_y INTEGER DEFAULT NULL, crop_zoom DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL, modified_at DATETIME NOT NULL, title VARCHAR(191) DEFAULT NULL, description VARCHAR(1000) DEFAULT NULL, original_filename VARCHAR(1000) DEFAULT NULL, copyright VARCHAR(191) DEFAULT NULL, author_id INTEGER DEFAULT NULL, CONSTRAINT FK_7BF75FB1F675F31B FOREIGN KEY (author_id) REFERENCES bolt_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_7BF75FB1F675F31B ON bolt_media (author_id)');
        $this->addSql('CREATE TABLE bolt_relation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, position INTEGER NOT NULL, from_content_id INTEGER NOT NULL, to_content_id INTEGER NOT NULL, CONSTRAINT FK_3431ED74AF0465EA FOREIGN KEY (from_content_id) REFERENCES bolt_content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_3431ED74A3934190 FOREIGN KEY (to_content_id) REFERENCES bolt_content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_3431ED74AF0465EA ON bolt_relation (from_content_id)');
        $this->addSql('CREATE INDEX IDX_3431ED74A3934190 ON bolt_relation (to_content_id)');
        $this->addSql('CREATE TABLE bolt_reset_password_request (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL, expires_at DATETIME NOT NULL, user_id INTEGER NOT NULL, CONSTRAINT FK_D04070DCA76ED395 FOREIGN KEY (user_id) REFERENCES bolt_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_D04070DCA76ED395 ON bolt_reset_password_request (user_id)');
        $this->addSql('CREATE TABLE bolt_taxonomy (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type VARCHAR(191) NOT NULL, slug VARCHAR(191) NOT NULL, name VARCHAR(191) NOT NULL, sortorder INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE bolt_taxonomy_content (taxonomy_id INTEGER NOT NULL, content_id INTEGER NOT NULL, PRIMARY KEY (taxonomy_id, content_id), CONSTRAINT FK_C5BCC03C9557E6F6 FOREIGN KEY (taxonomy_id) REFERENCES bolt_taxonomy (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_C5BCC03C84A0A3ED FOREIGN KEY (content_id) REFERENCES bolt_content (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_C5BCC03C9557E6F6 ON bolt_taxonomy_content (taxonomy_id)');
        $this->addSql('CREATE INDEX IDX_C5BCC03C84A0A3ED ON bolt_taxonomy_content (content_id)');
        $this->addSql('CREATE TABLE bolt_user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, display_name VARCHAR(255) NOT NULL, username VARCHAR(191) NOT NULL, email VARCHAR(191) NOT NULL, password VARCHAR(191) NOT NULL, roles CLOB NOT NULL, lastseen_at DATETIME DEFAULT NULL, last_ip VARCHAR(100) DEFAULT NULL, locale VARCHAR(191) DEFAULT NULL, backend_theme VARCHAR(191) DEFAULT NULL, status VARCHAR(30) DEFAULT \'enabled\' NOT NULL, avatar VARCHAR(250) DEFAULT NULL, about VARCHAR(1024) DEFAULT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57663792F85E0677 ON bolt_user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_57663792E7927C74 ON bolt_user (email)');
        $this->addSql('CREATE TABLE bolt_user_auth_token (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, useragent VARCHAR(255) NOT NULL, validity DATETIME NOT NULL, user_id INTEGER DEFAULT NULL, CONSTRAINT FK_8B90D313A76ED395 FOREIGN KEY (user_id) REFERENCES bolt_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_8B90D313A76ED395 ON bolt_user_auth_token (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bolt_content');
        $this->addSql('DROP TABLE bolt_field');
        $this->addSql('DROP TABLE bolt_field_translation');
        $this->addSql('DROP TABLE bolt_log');
        $this->addSql('DROP TABLE bolt_media');
        $this->addSql('DROP TABLE bolt_relation');
        $this->addSql('DROP TABLE bolt_reset_password_request');
        $this->addSql('DROP TABLE bolt_taxonomy');
        $this->addSql('DROP TABLE bolt_taxonomy_content');
        $this->addSql('DROP TABLE bolt_user');
        $this->addSql('DROP TABLE bolt_user_auth_token');
    }
}
