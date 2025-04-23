<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250423170943 extends AbstractMigration
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
            CREATE TABLE padrao_alimentar (id INT AUTO_INCREMENT NOT NULL, usuario_id_id INT DEFAULT NULL, dieta_especifica VARCHAR(999) DEFAULT NULL, restricao_alimentar JSON DEFAULT NULL COMMENT '(DC2Type:json)', preferencia_alimentar VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_C223F730629AF449 (usuario_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, sobrenome VARCHAR(255) DEFAULT NULL, idade INT DEFAULT NULL, sexo VARCHAR(1) DEFAULT NULL, altura NUMERIC(4, 2) DEFAULT NULL, peso NUMERIC(5, 2) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_1CDFAB827EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE treino_inteligente (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, objetivo VARCHAR(255) DEFAULT NULL, prompt LONGTEXT DEFAULT NULL, resultado LONGTEXT DEFAULT NULL, pontos_usados INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', nivel VARCHAR(255) DEFAULT NULL, local_treino VARCHAR(255) DEFAULT NULL, INDEX IDX_E31B7B0D7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE usuarios (id INT AUTO_INCREMENT NOT NULL, nome_usuario VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, senha VARCHAR(255) DEFAULT NULL, token VARCHAR(999) DEFAULT NULL, avatar MEDIUMTEXT DEFAULT NULL, credito BIGINT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', tentativas SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE padrao_alimentar ADD CONSTRAINT FK_C223F730629AF449 FOREIGN KEY (usuario_id_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB827EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE treino_inteligente ADD CONSTRAINT FK_E31B7B0D7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE padrao_alimentar DROP FOREIGN KEY FK_C223F730629AF449
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB827EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE treino_inteligente DROP FOREIGN KEY FK_E31B7B0D7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE login_session
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE padrao_alimentar
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pessoa
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE treino_inteligente
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE usuarios
        SQL);
    }
}
