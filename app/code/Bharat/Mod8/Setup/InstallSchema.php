<?php
namespace Bharat\Mod8\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('employee_table')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('employee_table')
            )
                ->addColumn(
                'employee_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
                'Employee ID'
            )
                ->addColumn(
                    'first_name',
                    Table::TYPE_TEXT,
                    30,
                    ['nullable' => false],
                    'First Name'
                )
                ->addColumn(
                    'last_name',
                    Table::TYPE_TEXT,
                    30,
                    ['nullable' => false],
                    'Last Name'
                )
                ->addColumn(
                    'email_id',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Email ID'
                )
                ->addColumn(
                    'address',
                    Table::TYPE_TEXT,
                    '2M',
                    ['nullable' => false],
                    'Address'
                )
                ->addColumn(
                    'phone_number',
                    Table::TYPE_TEXT,
                    15,
                    ['nullable' => false],
                    'Phone Number'
                )
                ->setComment('Employee Table');
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
