<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190612182642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    /**
     * @throws DBALException
     */
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $name = $this->connection->getDatabasePlatform()->getName();
        $this->abortIf($name !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('
            create table users
            (
                id       INTEGER      not null primary key autoincrement,
                username VARCHAR(255) not null,
                password VARCHAR(255) not null,
                email    VARCHAR(255) not null,
                status   INTEGER      not null default(1)
            );
        ');
    }

    /**
     * @throws DBALException
     */
    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $name = $this->connection->getDatabasePlatform()->getName();
        $this->abortIf($name !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');
        $this->addSql('DROP TABLE users');
    }
}
