<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200416140830 extends AbstractMigration
{
    public function getDescription() : string
    {
        $description = 'This migration adds indexes and foreign key constraints.';
        return $description;
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // Add index to book table
        $table = $schema->getTable('book');
        $table->addIndex(['date_created'], 'date_created_index');

        // Add index and foreign key to book table
        $table = $schema->getTable('book');
        $table->addIndex(['author_id'], 'author_id_index');
        $table->addForeignKeyConstraint('author', ['author_id'], ['id'], [], 'book_author_id_fk');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $table = $schema->getTable('book');
        $table->dropIndex('author_id_index');
        $table->removeForeignKey('book_author_id_fk');
        $table->dropIndex('date_created_index');

    }
}
