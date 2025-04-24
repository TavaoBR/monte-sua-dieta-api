<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424180814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE pacotes_fit_coins (id INT AUTO_INCREMENT NOT NULL, titulo VARCHAR(255) DEFAULT NULL, descricao VARCHAR(255) DEFAULT NULL, valor DOUBLE PRECISION DEFAULT NULL, qtd_coins INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, metodo VARCHAR(255) DEFAULT NULL, correlation_id VARCHAR(999) DEFAULT NULL, mpref_id VARCHAR(999) DEFAULT NULL, metadata_json JSON DEFAULT NULL COMMENT '(DC2Type:json)', created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', status VARCHAR(255) DEFAULT NULL, INDEX IDX_65D29B327EB2C349 (id_usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE payments ADD CONSTRAINT FK_65D29B327EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE payments DROP FOREIGN KEY FK_65D29B327EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pacotes_fit_coins
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE payments
        SQL);
    }
}
