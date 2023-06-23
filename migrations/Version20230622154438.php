<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230622154438 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, year DATE NOT NULL, kilometer INT NOT NULL, type VARCHAR(255) DEFAULT NULL, fuel VARCHAR(255) DEFAULT NULL, color VARCHAR(255) DEFAULT NULL, gearbox VARCHAR(255) DEFAULT NULL, fiscal_power INT DEFAULT NULL, real_power INT DEFAULT NULL, number_of_door INT DEFAULT NULL, number_of_place INT DEFAULT NULL, emission VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_equipment (car_id INT NOT NULL, equipment_id INT NOT NULL, INDEX IDX_D4DA27AFC3C6F69F (car_id), INDEX IDX_D4DA27AF517FE9FE (equipment_id), PRIMARY KEY(car_id, equipment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car_equipment ADD CONSTRAINT FK_D4DA27AFC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_equipment ADD CONSTRAINT FK_D4DA27AF517FE9FE FOREIGN KEY (equipment_id) REFERENCES equipment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE images ADD car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6AC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6AC3C6F69F ON images (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6AC3C6F69F');
        $this->addSql('ALTER TABLE car_equipment DROP FOREIGN KEY FK_D4DA27AFC3C6F69F');
        $this->addSql('ALTER TABLE car_equipment DROP FOREIGN KEY FK_D4DA27AF517FE9FE');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_equipment');
        $this->addSql('DROP INDEX IDX_E01FBE6AC3C6F69F ON images');
        $this->addSql('ALTER TABLE images DROP car_id');
    }
}
