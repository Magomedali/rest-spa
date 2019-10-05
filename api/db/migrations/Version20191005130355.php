<?php

declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191005130355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');
        
        $this->addSql('CREATE TABLE products (
            id INT(11) NOT NULL AUTO_INCREMENT
            , name VARCHAR(50) NOT NULL
            , price INT NOT NULL
            ,PRIMARY KEY (`id`))'
        );
        
        $this->addSql('CREATE TABLE orders (
            id INT(11) NOT NULL AUTO_INCREMENT
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , cost INT NOT NULL
            , status TINYINT NOT NULL DEFAULT 0
            , PRIMARY KEY (`id`))'
        );

        $this->addSql('CREATE TABLE order_products (
              order_id   INT(11) NOT NULL
            , product_id INT(11) NOT NULL
            , FOREIGN KEY (`product_id`) references products (`id`)
            , FOREIGN KEY (`order_id`) references orders (`id`)
            , UNIQUE KEY uk_order_product (`product_id`,`order_id`))'
        );

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE order_products');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE products');
    }
}
