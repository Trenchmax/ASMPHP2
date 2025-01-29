<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

final class CheckoutAddressesTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('checkout_addresses');
        $table->addColumn('user_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('address', 'text')
            ->addColumn('phone', 'string', ['limit' => 10])
            ->addColumn('province_id', 'integer', ['signed' => false])
            ->addColumn('district_id', 'integer', ['signed' => false])
            ->addColumn('ward_id', 'integer', ['signed' => false])
            ->addColumn('status', 'integer', ['limit' => MysqlAdapter::INT_TINY, 'default' => 1])
            ->addForeignKey('province_id', 'provinces', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('user_id', 'users', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('district_id', 'districts', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->addForeignKey('ward_id', 'wards', 'id', [
                'delete' => 'CASCADE',
                'update' => 'NO_ACTION'
            ])
            ->create();
    }
}

