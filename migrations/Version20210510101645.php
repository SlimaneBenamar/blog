<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210510101645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, titre VARCHAR(100) NOT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23A0E66FF7747B4 ON article (titre)');
        $this->addSql('CREATE TABLE article_categories (article_id INTEGER NOT NULL, categories_id INTEGER NOT NULL, PRIMARY KEY(article_id, categories_id))');
        $this->addSql('CREATE INDEX IDX_62A97E97294869C ON article_categories (article_id)');
        $this->addSql('CREATE INDEX IDX_62A97E9A21214B7 ON article_categories (categories_id)');
        $this->addSql('CREATE TABLE article_mot_cle (article_id INTEGER NOT NULL, mot_cle_id INTEGER NOT NULL, PRIMARY KEY(article_id, mot_cle_id))');
        $this->addSql('CREATE INDEX IDX_4240969D7294869C ON article_mot_cle (article_id)');
        $this->addSql('CREATE INDEX IDX_4240969DFE94535C ON article_mot_cle (mot_cle_id)');
        $this->addSql('CREATE TABLE categories (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, categorie VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3AF34668497DD634 ON categories (categorie)');
        $this->addSql('CREATE TABLE commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, article_id INTEGER NOT NULL, id_utilisateur_id INTEGER NOT NULL, contenu CLOB NOT NULL, date_creation DATETIME NOT NULL)');
        $this->addSql('CREATE INDEX IDX_67F068BC7294869C ON commentaire (article_id)');
        $this->addSql('CREATE INDEX IDX_67F068BCC6EE5C49 ON commentaire (id_utilisateur_id)');
        $this->addSql('CREATE TABLE mot_cle (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, mot_cle VARCHAR(50) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_AF92D22AAF92D22A ON mot_cle (mot_cle)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_categories');
        $this->addSql('DROP TABLE article_mot_cle');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE mot_cle');
    }
}
