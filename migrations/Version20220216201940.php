<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216201940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD automotive_id INT DEFAULT NULL, ADD job_id INT DEFAULT NULL, ADD real_estate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C17EBEBD03 FOREIGN KEY (automotive_id) REFERENCES automotive (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id)');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C11E4EB97C FOREIGN KEY (real_estate_id) REFERENCES real_estate (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C17EBEBD03 ON category (automotive_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C1BE04EA9 ON category (job_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_64C19C11E4EB97C ON category (real_estate_id)');
        $this->addSql('ALTER TABLE job DROP FOREIGN KEY FK_FBD8E0F812469DE2');
        $this->addSql('DROP INDEX IDX_FBD8E0F812469DE2 ON job');
        $this->addSql('ALTER TABLE job DROP category_id');
        $this->addSql('ALTER TABLE real_estate DROP FOREIGN KEY FK_DE4E97A812469DE2');
        $this->addSql('DROP INDEX IDX_DE4E97A812469DE2 ON real_estate');
        $this->addSql('ALTER TABLE real_estate DROP category_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C17EBEBD03');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1BE04EA9');
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C11E4EB97C');
        $this->addSql('DROP INDEX UNIQ_64C19C17EBEBD03 ON category');
        $this->addSql('DROP INDEX UNIQ_64C19C1BE04EA9 ON category');
        $this->addSql('DROP INDEX UNIQ_64C19C11E4EB97C ON category');
        $this->addSql('ALTER TABLE category DROP automotive_id, DROP job_id, DROP real_estate_id');
        $this->addSql('ALTER TABLE job ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE job ADD CONSTRAINT FK_FBD8E0F812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_FBD8E0F812469DE2 ON job (category_id)');
        $this->addSql('ALTER TABLE real_estate ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE real_estate ADD CONSTRAINT FK_DE4E97A812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DE4E97A812469DE2 ON real_estate (category_id)');
    }
}
