<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250413054607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE padrao_alimentar (id INT AUTO_INCREMENT NOT NULL, usuario_id_id INT DEFAULT NULL, dieta_especifica VARCHAR(999) DEFAULT NULL, restricao_alimentar JSON DEFAULT NULL COMMENT '(DC2Type:json)', preferencia_alimentar VARCHAR(1000) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_C223F730629AF449 (usuario_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE padrao_alimentar ADD CONSTRAINT FK_C223F730629AF449 FOREIGN KEY (usuario_id_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE padrao_alimentar DROP FOREIGN KEY FK_C223F730629AF449
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE padrao_alimentar
        SQL);
    }
}
