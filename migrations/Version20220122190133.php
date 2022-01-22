<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220122190133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locale CHANGE iso iso VARCHAR(8) NOT NULL');
        $this->addSql('ALTER TABLE vat DROP FOREIGN KEY FK_84B3223312469DE2');
        $this->addSql('ALTER TABLE vat ADD CONSTRAINT FK_84B3223312469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locale CHANGE iso iso VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE vat DROP FOREIGN KEY FK_84B3223312469DE2');
        $this->addSql('ALTER TABLE vat ADD CONSTRAINT FK_84B3223312469DE2 FOREIGN KEY (category_id) REFERENCES product (category_id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
