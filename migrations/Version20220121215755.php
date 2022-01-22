<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220121215755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create rates';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE rate_history_record_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE rate_history_record (id INT NOT NULL, at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, base VARCHAR(3) NOT NULL, values JSONB NOT NULL, inverse BOOL DEFAULT false, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE rate_history_record_id_seq CASCADE');
        $this->addSql('DROP TABLE rate_history_record');
    }
}
