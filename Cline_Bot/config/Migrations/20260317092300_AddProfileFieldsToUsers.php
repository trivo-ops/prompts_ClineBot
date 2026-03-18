<?php
declare(strict_types=1);

use Migrations\BaseMigration;

class AddProfileFieldsToUsers extends BaseMigration
{
    public function change(): void
    {
        $table = $this->table('users');
        $table
            ->addColumn('description', 'string', [
                'default' => null,
                'limit' => 500,
                'null' => true,
                'after' => 'email',
            ])
            ->addColumn('avatar_path', 'string', [
                'default' => null,
                'limit' => 255,
                'null' => true,
                'after' => 'description',
            ])
            ->update();
    }
}
