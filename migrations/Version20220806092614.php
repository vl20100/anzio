<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220806092614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE information_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ingredient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pizza_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pizza_of_month_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE price_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE information (id INT NOT NULL, description VARCHAR(255) NOT NULL, content TEXT NOT NULL, start DATE NOT NULL, "end" DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ingredient (id INT NOT NULL, name VARCHAR(255) NOT NULL, vegetarian BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pizza (id INT NOT NULL, name VARCHAR(255) NOT NULL, cream_base BOOLEAN NOT NULL, tomato_base BOOLEAN NOT NULL, truffle_base BOOLEAN DEFAULT false NOT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE pizza_ingredient (pizza_id INT NOT NULL, ingredient_id INT NOT NULL, PRIMARY KEY(pizza_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_6FF6C03FD41D1D42 ON pizza_ingredient (pizza_id)');
        $this->addSql('CREATE INDEX IDX_6FF6C03F933FE08C ON pizza_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE pizza_of_month (id INT NOT NULL, name VARCHAR(255) NOT NULL, cream_base BOOLEAN NOT NULL, tomato_base BOOLEAN NOT NULL, active BOOLEAN NOT NULL, month INT NOT NULL, shop TEXT NOT NULL, year INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN pizza_of_month.shop IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE pizza_of_month_ingredient (pizza_of_month_id INT NOT NULL, ingredient_id INT NOT NULL, PRIMARY KEY(pizza_of_month_id, ingredient_id))');
        $this->addSql('CREATE INDEX IDX_E85637AB50F04EB6 ON pizza_of_month_ingredient (pizza_of_month_id)');
        $this->addSql('CREATE INDEX IDX_E85637AB933FE08C ON pizza_of_month_ingredient (ingredient_id)');
        $this->addSql('CREATE TABLE price (id INT NOT NULL, pizza_id INT DEFAULT NULL, pizza_of_month_id INT DEFAULT NULL, price NUMERIC(5, 2) NOT NULL, size INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CAC822D9D41D1D42 ON price (pizza_id)');
        $this->addSql('CREATE INDEX IDX_CAC822D950F04EB6 ON price (pizza_of_month_id)');
        $this->addSql('ALTER TABLE pizza_ingredient ADD CONSTRAINT FK_6FF6C03FD41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pizza_ingredient ADD CONSTRAINT FK_6FF6C03F933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pizza_of_month_ingredient ADD CONSTRAINT FK_E85637AB50F04EB6 FOREIGN KEY (pizza_of_month_id) REFERENCES pizza_of_month (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pizza_of_month_ingredient ADD CONSTRAINT FK_E85637AB933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D9D41D1D42 FOREIGN KEY (pizza_id) REFERENCES pizza (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE price ADD CONSTRAINT FK_CAC822D950F04EB6 FOREIGN KEY (pizza_of_month_id) REFERENCES pizza_of_month (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE pizza_ingredient DROP CONSTRAINT FK_6FF6C03F933FE08C');
        $this->addSql('ALTER TABLE pizza_of_month_ingredient DROP CONSTRAINT FK_E85637AB933FE08C');
        $this->addSql('ALTER TABLE pizza_ingredient DROP CONSTRAINT FK_6FF6C03FD41D1D42');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D9D41D1D42');
        $this->addSql('ALTER TABLE pizza_of_month_ingredient DROP CONSTRAINT FK_E85637AB50F04EB6');
        $this->addSql('ALTER TABLE price DROP CONSTRAINT FK_CAC822D950F04EB6');
        $this->addSql('DROP SEQUENCE information_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ingredient_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pizza_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pizza_of_month_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE price_id_seq CASCADE');
        $this->addSql('DROP TABLE information');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE pizza');
        $this->addSql('DROP TABLE pizza_ingredient');
        $this->addSql('DROP TABLE pizza_of_month');
        $this->addSql('DROP TABLE pizza_of_month_ingredient');
        $this->addSql('DROP TABLE price');
    }
}
