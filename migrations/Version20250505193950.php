<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250505193950 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE perfil_nutricional (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, objetivo VARCHAR(999) DEFAULT NULL, nivel_atividade VARCHAR(999) DEFAULT NULL, preferencias_alimentares VARCHAR(999) DEFAULT NULL, condicoes_medica VARCHAR(999) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', restricoes_alimentares VARCHAR(999) DEFAULT NULL, alergias VARCHAR(999) DEFAULT NULL, INDEX IDX_A56DD19F7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE perfil_nutricional ADD CONSTRAINT FK_A56DD19F7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE perfil_nutricional DROP FOREIGN KEY FK_A56DD19F7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE perfil_nutricional
        SQL);
    }
}
