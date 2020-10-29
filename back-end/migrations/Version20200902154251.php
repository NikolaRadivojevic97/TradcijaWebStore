<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200902154251 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE covers DROP FOREIGN KEY FK_F08DF1B27D949DCC');
        $this->addSql('ALTER TABLE covers DROP FOREIGN KEY FK_F08DF1B2C3C6F69F');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B27D949DCC FOREIGN KEY (combination_id) REFERENCES combination (id)');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B2C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE covers DROP FOREIGN KEY FK_F08DF1B2C3C6F69F');
        $this->addSql('ALTER TABLE covers DROP FOREIGN KEY FK_F08DF1B27D949DCC');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B2C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B27D949DCC FOREIGN KEY (combination_id) REFERENCES combination (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP username');
    }
}
