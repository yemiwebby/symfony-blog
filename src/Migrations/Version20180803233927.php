<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180803233927 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, password VARCHAR(64) NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE post CHANGE author_id author_id INT DEFAULT NULL, CHANGE description description VARCHAR(2000) DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE author CHANGE short_bio short_bio VARCHAR(500) DEFAULT NULL, CHANGE phone phone VARCHAR(255) DEFAULT NULL, CHANGE facebook facebook VARCHAR(255) DEFAULT NULL, CHANGE twitter twitter VARCHAR(255) DEFAULT NULL, CHANGE github github VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE author CHANGE short_bio short_bio VARCHAR(500) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE phone phone VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE facebook facebook VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE twitter twitter VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE github github VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE post CHANGE author_id author_id INT DEFAULT NULL, CHANGE description description VARCHAR(2000) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT \'NULL\'');
    }
}
