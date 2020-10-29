<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827095814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE combination_car');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE combination_car (combination_id INT NOT NULL, car_id INT NOT NULL, INDEX IDX_8E469408C3C6F69F (car_id), INDEX IDX_8E4694087D949DCC (combination_id), PRIMARY KEY(combination_id, car_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE combination_car ADD CONSTRAINT FK_8E4694087D949DCC FOREIGN KEY (combination_id) REFERENCES combination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combination_car ADD CONSTRAINT FK_8E469408C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
    }
}
