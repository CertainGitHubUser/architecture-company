<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607150101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "apartment_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "apartment" (id INT NOT NULL, exposed_id VARCHAR(36) NOT NULL, user_id INT NOT NULL, square DOUBLE PRECISION NOT NULL, floor INT NOT NULL, built_in DATE NOT NULL, price INT NOT NULL, apartment_type VARCHAR(60) NOT NULL, heating_type VARCHAR(60) NOT NULL, rental_price INT DEFAULT NULL, currency VARCHAR(10) NOT NULL, has_gas BOOLEAN NOT NULL, has_water BOOLEAN NOT NULL, has_hood BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN "apartment".built_in IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "apartment_id_seq" CASCADE');
        $this->addSql('DROP TABLE "apartment"');
    }
}
