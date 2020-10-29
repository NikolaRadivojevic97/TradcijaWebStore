<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827100512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE covers (id INT AUTO_INCREMENT NOT NULL, car_id INT NOT NULL, combination_id INT NOT NULL, url VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_F08DF1B2C3C6F69F (car_id), INDEX IDX_F08DF1B27D949DCC (combination_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B2C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE covers ADD CONSTRAINT FK_F08DF1B27D949DCC FOREIGN KEY (combination_id) REFERENCES combination (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE covers');
    }
}
