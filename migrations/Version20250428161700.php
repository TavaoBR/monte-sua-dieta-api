<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250428161700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE grupo_muscular_prioritario (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, grupo_muscular VARCHAR(255) DEFAULT NULL, nivel VARCHAR(255) DEFAULT NULL, qtd_fit_coins DOUBLE PRECISION DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_30E108AE7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE lista_exercicios (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, id_gmp_id INT DEFAULT NULL, exercicio VARCHAR(999) DEFAULT NULL, musculo_ativado VARCHAR(999) DEFAULT NULL, equipamento VARCHAR(999) DEFAULT NULL, series INT DEFAULT NULL, repeticoes INT DEFAULT NULL, dificuldade VARCHAR(255) DEFAULT NULL, token LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_329198DF7EB2C349 (id_usuario_id), INDEX IDX_329198DF119924EE (id_gmp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE grupo_muscular_prioritario ADD CONSTRAINT FK_30E108AE7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lista_exercicios ADD CONSTRAINT FK_329198DF7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lista_exercicios ADD CONSTRAINT FK_329198DF119924EE FOREIGN KEY (id_gmp_id) REFERENCES grupo_muscular_prioritario (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE grupo_muscular_prioritario DROP FOREIGN KEY FK_30E108AE7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lista_exercicios DROP FOREIGN KEY FK_329198DF7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE lista_exercicios DROP FOREIGN KEY FK_329198DF119924EE
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE grupo_muscular_prioritario
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE lista_exercicios
        SQL);
    }
}
