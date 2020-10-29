<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200923205351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE shopping_cart_covers (shopping_cart_id INT NOT NULL, covers_id INT NOT NULL, INDEX IDX_7C1EA8CB45F80CD (shopping_cart_id), INDEX IDX_7C1EA8CB3E35C0DF (covers_id), PRIMARY KEY(shopping_cart_id, covers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE shopping_cart_covers ADD CONSTRAINT FK_7C1EA8CB45F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE shopping_cart_covers ADD CONSTRAINT FK_7C1EA8CB3E35C0DF FOREIGN KEY (covers_id) REFERENCES covers (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE covers_shopping_cart');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE covers_shopping_cart (covers_id INT NOT NULL, shopping_cart_id INT NOT NULL, INDEX IDX_A492725745F80CD (shopping_cart_id), INDEX IDX_A49272573E35C0DF (covers_id), PRIMARY KEY(covers_id, shopping_cart_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE covers_shopping_cart ADD CONSTRAINT FK_A49272573E35C0DF FOREIGN KEY (covers_id) REFERENCES covers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE covers_shopping_cart ADD CONSTRAINT FK_A492725745F80CD FOREIGN KEY (shopping_cart_id) REFERENCES shopping_cart (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE shopping_cart_covers');
    }
}
