<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240128211758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Desc';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recettes ADD image_size INT DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE recettes DROP image_size, DROP updated_at');
    }
}
