<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210618135719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD COLUMN filename VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_62A97E97294869C');
        $this->addSql('DROP INDEX IDX_62A97E9A21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_categories AS SELECT article_id, categories_id FROM article_categories');
        $this->addSql('DROP TABLE article_categories');
        $this->addSql('CREATE TABLE article_categories (article_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(article_id, categories_id), CONSTRAINT FK_62A97E97294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_62A97E9A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article_categories (article_id, categories_id) SELECT article_id, categories_id FROM __temp__article_categories');
        $this->addSql('DROP TABLE __temp__article_categories');
        $this->addSql('CREATE INDEX IDX_62A97E97294869C ON article_categories (article_id)');
        $this->addSql('CREATE INDEX IDX_62A97E9A21214B7 ON article_categories (categories_id)');
        $this->addSql('DROP INDEX IDX_4240969D7294869C');
        $this->addSql('DROP INDEX IDX_4240969DFE94535C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_mot_cle AS SELECT article_id, mot_cle_id FROM article_mot_cle');
        $this->addSql('DROP TABLE article_mot_cle');
        $this->addSql('CREATE TABLE article_mot_cle (article_id INTEGER NOT NULL, mot_cle_id INTEGER NOT NULL, PRIMARY KEY(article_id, mot_cle_id), CONSTRAINT FK_4240969D7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4240969DFE94535C FOREIGN KEY (mot_cle_id) REFERENCES mot_cle (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO article_mot_cle (article_id, mot_cle_id) SELECT article_id, mot_cle_id FROM __temp__article_mot_cle');
        $this->addSql('DROP TABLE __temp__article_mot_cle');
        $this->addSql('CREATE INDEX IDX_4240969D7294869C ON article_mot_cle (article_id)');
        $this->addSql('CREATE INDEX IDX_4240969DFE94535C ON article_mot_cle (mot_cle_id)');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C');
        $this->addSql('DROP INDEX IDX_67F068BCC6EE5C49');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, article_id, id_utilisateur_id, contenu, date_creation FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL, id_utilisateur_id INTEGER NOT NULL, contenu CLOB NOT NULL COLLATE BINARY, date_creation DATETIME NOT NULL, CONSTRAINT FK_67F068BC7294869C FOREIGN KEY (article_id) REFERENCES article (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_67F068BCC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO commentaire (id, article_id, id_utilisateur_id, contenu, date_creation) SELECT id, article_id, id_utilisateur_id, contenu, date_creation FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCC6EE5C49 ON commentaire (id_utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_23A0E66FF7747B4');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article AS SELECT id, titre, contenu, date_creation, date_modification FROM article');
        $this->addSql('DROP TABLE article');
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(150) NOT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME NOT NULL)');
        $this->addSql('INSERT INTO article (id, titre, contenu, date_creation, date_modification) SELECT id, titre, contenu, date_creation, date_modification FROM __temp__article');
        $this->addSql('DROP TABLE __temp__article');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66FF7747B4 ON article (titre)');
        $this->addSql('DROP INDEX IDX_62A97E97294869C');
        $this->addSql('DROP INDEX IDX_62A97E9A21214B7');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_categories AS SELECT article_id, categories_id FROM article_categories');
        $this->addSql('DROP TABLE article_categories');
        $this->addSql('CREATE TABLE article_categories (article_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(article_id, categories_id))');
        $this->addSql('INSERT INTO article_categories (article_id, categories_id) SELECT article_id, categories_id FROM __temp__article_categories');
        $this->addSql('DROP TABLE __temp__article_categories');
        $this->addSql('CREATE INDEX IDX_62A97E97294869C ON article_categories (article_id)');
        $this->addSql('CREATE INDEX IDX_62A97E9A21214B7 ON article_categories (categories_id)');
        $this->addSql('DROP INDEX IDX_4240969D7294869C');
        $this->addSql('DROP INDEX IDX_4240969DFE94535C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__article_mot_cle AS SELECT article_id, mot_cle_id FROM article_mot_cle');
        $this->addSql('DROP TABLE article_mot_cle');
        $this->addSql('CREATE TABLE article_mot_cle (article_id INTEGER NOT NULL, mot_cle_id INTEGER NOT NULL, PRIMARY KEY(article_id, mot_cle_id))');
        $this->addSql('INSERT INTO article_mot_cle (article_id, mot_cle_id) SELECT article_id, mot_cle_id FROM __temp__article_mot_cle');
        $this->addSql('DROP TABLE __temp__article_mot_cle');
        $this->addSql('CREATE INDEX IDX_4240969D7294869C ON article_mot_cle (article_id)');
        $this->addSql('CREATE INDEX IDX_4240969DFE94535C ON article_mot_cle (mot_cle_id)');
        $this->addSql('DROP INDEX IDX_67F068BC7294869C');
        $this->addSql('DROP INDEX IDX_67F068BCC6EE5C49');
        $this->addSql('CREATE TEMPORARY TABLE __temp__commentaire AS SELECT id, article_id, id_utilisateur_id, contenu, date_creation FROM commentaire');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL, id_utilisateur_id INTEGER NOT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL)');
        $this->addSql('INSERT INTO commentaire (id, article_id, id_utilisateur_id, contenu, date_creation) SELECT id, article_id, id_utilisateur_id, contenu, date_creation FROM __temp__commentaire');
        $this->addSql('DROP TABLE __temp__commentaire');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCC6EE5C49 ON commentaire (id_utilisateur_id)');
    }
}
