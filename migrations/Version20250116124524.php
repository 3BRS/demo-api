<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250116124524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql("INSERT INTO address (id, country, street, city, postcode) VALUES (nextval('address_id_seq'), 'CZ', 'Radlická 55', 'Prague', '15000')");
        $this->addSql("INSERT INTO customer (id, first_name, last_name, email, phone, date_of_birth, address_home_id) VALUES (nextval('customer_id_seq'), 'John', 'Doe', 'john@example.com', '123456789', '2000-10-10', currval('address_id_seq'))");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
