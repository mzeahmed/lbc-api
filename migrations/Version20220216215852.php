<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216215852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17EBEBD03');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1BE04EA9');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C11E4EB97C');
        $this->addSql('CREATE TABLE car_brand (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_model (id INT AUTO_INCREMENT NOT NULL, brand_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_83EF70E44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_model ADD CONSTRAINT FK_83EF70E44F5D008 FOREIGN KEY (brand_id) REFERENCES car_brand (id)');
        $this->addSql('DROP TABLE automotive');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE real_estate');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5812469DE2');
        $this->addSql('DROP INDEX IDX_77E0ED5812469DE2 ON ad');
        $this->addSql('ALTER TABLE ad DROP category_id');
        $this->addSql('DROP INDEX UNIQ_64C19C11E4EB97C ON category');
        $this->addSql('DROP INDEX UNIQ_64C19C17EBEBD03 ON category');
        $this->addSql('DROP INDEX UNIQ_64C19C1BE04EA9 ON category');
        $this->addSql('ALTER TABLE category ADD name VARCHAR(255) NOT NULL, DROP automotive_id, DROP job_id, DROP real_estate_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_model DROP FOREIGN KEY FK_83EF70E44F5D008');
        $this->addSql('CREATE TABLE automotive (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, model VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, models LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE job (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE real_estate (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE car_brand');
        $this->addSql('DROP TABLE car_model');
        $this->addSql('ALTER TABLE ad ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_77E0ED5812469DE2 ON ad (category_id)');
        $this->addSql('ALTER TABLE category ADD automotive_id INT DEFAULT NULL, ADD job_id INT DEFAULT NULL, ADD real_estate_id INT DEFAULT NULL, DROP name');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11E4EB97C FOREIGN KEY (real_estate_id) REFERENCES real_estate (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17EBEBD03 FOREIGN KEY (automotive_id) REFERENCES automotive (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C11E4EB97C ON category (real_estate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C17EBEBD03 ON category (automotive_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C1BE04EA9 ON category (job_id)');
    }
}
