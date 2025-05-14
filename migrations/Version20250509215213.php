<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250509215213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE plano_alimentar (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, nome_plano VARCHAR(999) DEFAULT NULL, refeicoes JSON DEFAULT NULL COMMENT '(DC2Type:json)', totais_diarios JSON DEFAULT NULL COMMENT '(DC2Type:json)', sugestao_melhoria VARCHAR(20000) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', token VARCHAR(999) DEFAULT NULL, INDEX IDX_93B4036F7EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE plano_alimentar ADD CONSTRAINT FK_93B4036F7EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE plano_alimentar DROP FOREIGN KEY FK_93B4036F7EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE plano_alimentar
        SQL);
    }
}
