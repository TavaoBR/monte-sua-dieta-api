<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250502031919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE exercicios_ficha (id INT AUTO_INCREMENT NOT NULL, id_ficha_id INT DEFAULT NULL, dia_semana VARCHAR(255) DEFAULT NULL, grupo_muscular VARCHAR(999) DEFAULT NULL, array_excercicios JSON DEFAULT NULL COMMENT '(DC2Type:json)', cardio LONGTEXT DEFAULT NULL, aquecimento LONGTEXT DEFAULT NULL, observacoes LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', token VARCHAR(999) DEFAULT NULL, INDEX IDX_AE2A8652EB5ECA (id_ficha_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE ficha_treino (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, token VARCHAR(999) DEFAULT NULL, experiencia VARCHAR(255) DEFAULT NULL, dificuldade VARCHAR(255) DEFAULT NULL, observacoes VARCHAR(500) DEFAULT NULL, nome_ficha VARCHAR(255) DEFAULT NULL, pontos_usados DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_FDB833887EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE exercicios_ficha ADD CONSTRAINT FK_AE2A8652EB5ECA FOREIGN KEY (id_ficha_id) REFERENCES ficha_treino (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ficha_treino ADD CONSTRAINT FK_FDB833887EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE exercicios_ficha DROP FOREIGN KEY FK_AE2A8652EB5ECA
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE ficha_treino DROP FOREIGN KEY FK_FDB833887EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE exercicios_ficha
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ficha_treino
        SQL);
    }
}
