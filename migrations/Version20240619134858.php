<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240619134858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert info';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("INSERT INTO `group` (id, name) VALUES (1, 'Lead'),
                                      (2, 'Developer'),
                                      (3, 'HR'),
                                      (4, 'QA');");
        $this->addSql("INSERT INTO user (id, user_group_id, name, email)
                                VALUES (1, 1, 'Denzel Morgan', 'denzel7066@dovinou.com'),
                                       (2, 1, 'Carlos Matthams', 'carlos7066@dovinou.com'),
                                       (3, 2, 'Sulayman Frye', 'sulayman7066@dovinou.com'),
                                       (4, 2, 'Seamus Ayala', 'seamus@dovinou.com'),
                                       (5, 1, 'Findlay Vance', 'findlay@dovinou.com'),
                                       (6, 3, 'Ameer Beck', 'beck@dovinou.com'),
                                       (7, 3, 'Harley Rivers', 'harley@dovinou.com'),
                                       (8, 4, 'Dawson Mueller', 'dawson@dovinou.com'),
                                       (9, 2, 'Alfred Sparks', 'sparks@dovinou.com'),
                                       (10, 2, 'Devon Williamson', 'williamon@dovinou.com')
                            ;");
    }

    public function down(Schema $schema): void
    {
    }
}
