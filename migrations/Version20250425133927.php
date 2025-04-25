<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425133927 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE pagamento_pacote_fit_coins (id INT AUTO_INCREMENT NOT NULL, id_usuario_id INT DEFAULT NULL, id_fit_coins_id INT DEFAULT NULL, metodo_pagamento VARCHAR(255) DEFAULT NULL, correlation_id VARCHAR(1000) DEFAULT NULL, id_pagamento_mercado_pago VARCHAR(999) DEFAULT NULL, metadata_json JSON DEFAULT NULL COMMENT '(DC2Type:json)', status VARCHAR(30) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', updated_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_8FD024E67EB2C349 (id_usuario_id), INDEX IDX_8FD024E62C4266B7 (id_fit_coins_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pagamento_pacote_fit_coins ADD CONSTRAINT FK_8FD024E67EB2C349 FOREIGN KEY (id_usuario_id) REFERENCES usuarios (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pagamento_pacote_fit_coins ADD CONSTRAINT FK_8FD024E62C4266B7 FOREIGN KEY (id_fit_coins_id) REFERENCES pacotes_fit_coins (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE pagamento_pacote_fit_coins DROP FOREIGN KEY FK_8FD024E67EB2C349
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE pagamento_pacote_fit_coins DROP FOREIGN KEY FK_8FD024E62C4266B7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE pagamento_pacote_fit_coins
        SQL);
    }
}
