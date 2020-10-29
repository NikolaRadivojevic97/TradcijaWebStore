<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923164745 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_paymnet');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE shopping_cart_covers');
        $this->addSql('ALTER TABLE combination CHANGE url url VARCHAR(1000) NOT NULL');
        $this->addSql('DROP INDEX FK_paymnet ON `order`');
        $this->addSql('ALTER TABLE `order` DROP payment_id, CHANGE shopping_cart_id shopping_cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping_info ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE shipping_info ADD CONSTRAINT FK_5A35A755A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A35A755A76ED395 ON shipping_info (user_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495D8BC1F8');
        $this->addSql('DROP INDEX UNIQ_8D93D6495D8BC1F8 ON user');
        $this->addSql('ALTER TABLE user DROP info_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shopping_cart_covers (shopping_cart_id INT NOT NULL, covers_id INT NOT NULL, INDEX IDX_7C1EA8CB45F80CD (shopping_cart_id), INDEX IDX_7C1EA8CB3E35C0DF (covers_id), PRIMARY KEY(shopping_cart_id, covers_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE shopping_cart_covers ADD CONSTRAINT FK_7C1EA8CB3E35C0DF FOREIGN KEY (covers_id) REFERENCES covers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_cart_covers ADD CONSTRAINT FK_7C1EA8CB45F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE combination CHANGE url url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `order` ADD payment_id INT NOT NULL, CHANGE shopping_cart_id shopping_cart_id INT NOT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_paymnet FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX FK_paymnet ON `order` (payment_id)');
        $this->addSql('ALTER TABLE shipping_info DROP FOREIGN KEY FK_5A35A755A76ED395');
        $this->addSql('DROP INDEX UNIQ_5A35A755A76ED395 ON shipping_info');
        $this->addSql('ALTER TABLE shipping_info DROP user_id');
        $this->addSql('ALTER TABLE user ADD info_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495D8BC1F8 FOREIGN KEY (info_id) REFERENCES shipping_info (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495D8BC1F8 ON user (info_id)');
    }
}
