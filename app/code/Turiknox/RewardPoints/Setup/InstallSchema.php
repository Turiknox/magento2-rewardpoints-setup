<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (!$installer->tableExists('turiknox_rewardpoints_quote_address')) {
            $pointsQuoteTable = $installer->getConnection()
                ->newTable($installer->getTable('turiknox_rewardpoints_quote_address'))
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'quote_address_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Quote Address ID'
                )
                ->addColumn(
                    'base_loyaltypoints_amount',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Base Loyalty Points Amount'
                )
                ->addColumn(
                    'loyaltypoints_amount',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Loyalty Points Amount'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'turiknox_loyaltypoints/quote',
                        ['entity_id'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['entity_id'],
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'turiknox_rewardpoints_quote_address',
                        'quote_address_id',
                        'quote_address',
                        'address_id'
                    ),
                    'quote_address_id',
                    'quote_address',
                    'address_id',
                    Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($pointsQuoteTable);
        }


        if (!$installer->tableExists('turiknox_loyaltypoints_order')) {
            $pointsOrdersTable = $installer->getConnection()
                ->newTable($installer->getTable('turiknox_loyaltypoints_order'))
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'order_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Order ID'
                )
                ->addColumn(
                    'base_rewardpoints_amount',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Base Reward Points Amount'
                )
                ->addColumn(
                    'rewardpoints_amount',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Reward Points Amount'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'turiknox_loyaltypoints_order',
                        ['entity_id'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['entity_id'],
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'turiknox_loyaltypoints_order',
                        'order_id',
                        'sales_order',
                        'entity_id'
                    ),
                    'order_id',
                    'sales_order',
                    'entity_id',
                    Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($pointsOrdersTable);
        }


        if (!$installer->tableExists('turiknox_rewardpoints_customer')) {
            $pointsCustomersTable = $installer->getConnection()
                ->newTable($installer->getTable('turiknox_rewardpoints_customer'))
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'customer_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Customer ID'
                )
                ->addColumn(
                    'reward_points',
                    Table::TYPE_DECIMAL,
                    '12,4',
                    [],
                    'Reward Points'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'turiknox_rewardpoints_customer',
                        ['entity_id'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['entity_id'],
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'turiknox_rewardpoints_customer',
                        'customer_id',
                        'customer_entity',
                        'entity_id'
                    ),
                    'customer_id',
                    $installer->getTable('customer_entity'),
                    'entity_id',
                    Table::ACTION_CASCADE,
                    Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($pointsCustomersTable);
        }


        if (!$installer->tableExists('turiknox_rewardpoints_rate')) {
            $pointsRateTable = $installer->getConnection()
                ->newTable($installer->getTable('turiknox_rewardpoints_rate'))
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Name'
                )
                ->addColumn(
                    'website_ids',
                    Table::TYPE_TEXT,
                    null,
                    [],
                    'Website IDs'
                )
                ->addColumn(
                    'customer_group_ids',
                    Table::TYPE_TEXT,
                    null,
                    [],
                    'Customer Group IDs'
                )
                ->addColumn(
                    'direction',
                    Table::TYPE_SMALLINT,
                    null,
                    [],
                    'Direction'
                )
                ->addColumn(
                    'points',
                    Table::TYPE_INTEGER,
                    11,
                    [],
                    'Points'
                )
                ->addColumn(
                    'money',
                    Table::TYPE_FLOAT,
                    null,
                    [],
                    'Money'
                )
                ->addColumn(
                    'sort_order',
                    Table::TYPE_INTEGER,
                    11,
                    [],
                    'Sort Order'
                );
            $installer->getConnection()->createTable($pointsRateTable);
        }

        if (!$installer->tableExists('turiknox_rewardpoints_transaction')) {
            $pointsTransactionsTable = $installer->getConnection()
                ->newTable($installer->getTable('turiknox_rewardpoints_transaction'))
                ->addColumn(
                    'entity_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity'  => true,
                        'unsigned'  => true,
                        'nullable'  => false,
                        'primary'   => true,
                    ],
                    'Entity ID'
                )
                ->addColumn(
                    'store_id',
                    Table::TYPE_SMALLINT,
                    null,
                    ['unsigned' => true],
                    'Store Id'
                )
                ->addColumn(
                    'order_id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'Order ID'
                )
                ->addColumn(
                    'customer_name',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Customer Name'
                )
                ->addColumn(
                    'customer_email',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Customer Email'
                )
                ->addColumn(
                    'balance_change',
                    Table::TYPE_INTEGER,
                    11,
                    [],
                    'Balance Change'
                )
                ->addColumn(
                    'balance_remaining',
                    Table::TYPE_INTEGER,
                    11,
                    [],
                    'Balance Remaining'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                    'Created At'
                )
                ->addIndex(
                    $installer->getIdxName(
                        'turiknox_rewardpoints_transaction',
                        ['entity_id'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    ['entity_id'],
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'turiknox_rewardpoints_transaction',
                        'order_id',
                        'sales_order',
                        'entity_id'
                    ),
                    'order_id',
                    $installer->getTable('sales_order'),
                    'entity_id',
                    Table::ACTION_CASCADE,
                    Table::ACTION_CASCADE
                );
            $installer->getConnection()->createTable($pointsTransactionsTable);
        }
    }
}
