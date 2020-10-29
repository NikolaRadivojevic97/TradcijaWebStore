<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200924090649 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE19D46269 FOREIGN KEY (paymnet_id) REFERENCES paymnet (id)');
        $this->addSql('CREATE INDEX IDX_E52FFDEE19D46269 ON orders (paymnet_id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6495D8BC1F8 FOREIGN KEY (info_id) REFERENCES shipping_info (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495D8BC1F8 ON user (info_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE19D46269');
        $this->addSql('DROP INDEX IDX_E52FFDEE19D46269 ON orders');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6495D8BC1F8');
        $this->addSql('DROP INDEX UNIQ_8D93D6495D8BC1F8 ON user');
    }
}
