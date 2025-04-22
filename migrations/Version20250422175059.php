<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250422175059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE treino_inteligente (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, objetivo VARCHAR(255) DEFAULT NULL, prompt LONGTEXT DEFAULT NULL, resultado LONGTEXT DEFAULT NULL, pontos_usados INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_E31B7B0D7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE treino_inteligente ADD CONSTRAINT FK_E31B7B0D7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE treino_inteligente DROP FOREIGN KEY FK_E31B7B0D7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE treino_inteligente
        SQL);
    }
}
