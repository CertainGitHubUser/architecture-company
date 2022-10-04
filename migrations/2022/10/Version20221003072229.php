<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003072229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apartment ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE apartment ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE apartment ALTER built_in TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE apartment ALTER built_in DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN apartment.built_in IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "apartment" DROP title');
        $this->addSql('ALTER TABLE "apartment" DROP description');
        $this->addSql('ALTER TABLE "apartment" ALTER built_in TYPE DATE');
        $this->addSql('ALTER TABLE "apartment" ALTER built_in DROP DEFAULT');
        $this->addSql('COMMENT ON COLUMN "apartment".built_in IS \'(DC2Type:date_immutable)\'');
    }
}
