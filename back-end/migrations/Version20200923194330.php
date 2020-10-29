<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923194330 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, shopping_cart_id INT NOT NULL, status VARCHAR(255) NOT NULL, date DATETIME NOT NULL, total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_E52FFDEE45F80CD (shopping_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE45F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id)');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('ALTER TABLE shopping_cart ADD orders_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shopping_cart ADD CONSTRAINT FK_72AAD4F6CFFE9AD6 FOREIGN KEY (orders_id) REFERENCES orders (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_72AAD4F6CFFE9AD6 ON shopping_cart (orders_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE shopping_cart DROP FOREIGN KEY FK_72AAD4F6CFFE9AD6');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, shopping_cart_id INT DEFAULT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_F529939845F80CD (shopping_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F529939845F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id)');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP INDEX UNIQ_72AAD4F6CFFE9AD6 ON shopping_cart');
        $this->addSql('ALTER TABLE shopping_cart DROP orders_id');
    }
}
