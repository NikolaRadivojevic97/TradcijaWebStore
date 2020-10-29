<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200827123925 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, status VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_F52993989395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_covers (order_id INT NOT NULL, covers_id INT NOT NULL, INDEX IDX_3302E1678D9F6D38 (order_id), INDEX IDX_3302E1673E35C0DF (covers_id), PRIMARY KEY(order_id, covers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_covers (user_id INT NOT NULL, covers_id INT NOT NULL, INDEX IDX_95DFEA8FA76ED395 (user_id), INDEX IDX_95DFEA8F3E35C0DF (covers_id), PRIMARY KEY(user_id, covers_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989395C3F3 FOREIGN KEY (customer_id) REFERENCES shipping_info (id)');
        $this->addSql('ALTER TABLE order_covers ADD CONSTRAINT FK_3302E1678D9F6D38 FOREIGN KEY (order_id) REFERENCES `order` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE order_covers ADD CONSTRAINT FK_3302E1673E35C0DF FOREIGN KEY (covers_id) REFERENCES covers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_covers ADD CONSTRAINT FK_95DFEA8FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_covers ADD CONSTRAINT FK_95DFEA8F3E35C0DF FOREIGN KEY (covers_id) REFERENCES covers (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model ADD CONSTRAINT FK_D79572D944F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE order_covers DROP FOREIGN KEY FK_3302E1678D9F6D38');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_covers');
        $this->addSql('DROP TABLE user_covers');
    }
}
