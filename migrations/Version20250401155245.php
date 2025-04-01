<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250401155245 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE login_session (id INT AUTO_INCREMENT NOT NULL, usuario_id BIGINT DEFAULT NULL, login_date_time DATETIME DEFAULT NULL, expire_date_time DATETIME DEFAULT NULL, session_metadata_json MEDIUMTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nome_usuario VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, senha VARCHAR(255) DEFAULT NULL, token VARCHAR(999) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, credito BIGINT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', tentativas SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE login_session
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE usuarios
        SQL);
    }
}
