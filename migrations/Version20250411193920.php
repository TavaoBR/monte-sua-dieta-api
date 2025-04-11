<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250411193920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE pessoa (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, nome VARCHAR(255) NOT NULL, sobrenome VARCHAR(255) DEFAULT NULL, idade INT DEFAULT NULL, sexo VARCHAR(1) DEFAULT NULL, altura NUMERIC(4, 2) DEFAULT NULL, peso NUMERIC(5, 2) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', UNIQUE INDEX UNIQ_1CDFAB827EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pessoa ADD CONSTRAINT FK_1CDFAB827EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE usuarios CHANGE avatar avatar MEDIUMTEXT DEFAULT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE pessoa DROP FOREIGN KEY FK_1CDFAB827EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pessoa
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE usuarios CHANGE avatar avatar VARCHAR(10000) DEFAULT NULL
        SQL);
    }
}
