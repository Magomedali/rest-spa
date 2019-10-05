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
            , title VARCHAR(50) NOT NULL
            , price int NOT NULL
            ,PRIMARY KEY (`id`))'
        );
        
        $this->addSql('CREATE TABLE orders (
            id INT(11) NOT NULL AUTO_INCREMENT
            , product_id INTEGER NOT NULL
            , created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            , status TINYINT NOT NULL DEFAULT 0
            , PRIMARY KEY (`id`)
            , FOREIGN KEY (`product_id`) references products (`id`))'
        );

    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE products');
    }
}
