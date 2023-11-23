<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Task extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('task');
        $table->addColumn('user_id', 'integer', [
            'limit' => 11,
            'null' => false,
            'after' => 'id',
        ]);
        $table->update();
    }
}
