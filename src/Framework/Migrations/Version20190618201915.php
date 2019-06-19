<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190618201915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->abortIf($this->isMysql(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('
            CREATE TABLE users (
                id VARCHAR(255) NOT NULL,
                username VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                PRIMARY KEY(id)
            ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB
        ');
    }

    public function down(Schema $schema): void
    {
        $this->abortIf($this->isMysql(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE users');
    }

    public function isMysql(): bool
    {
        return $this->connection->getDatabasePlatform()->getName() !== 'mysql';
    }
}
