<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Model\ResourceModel\Transaction;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id'; // @codingStandardsIgnoreLine

    /**
     * Collection initialisation
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init(
            'Turiknox\RewardPoints\Model\Transaction',
            'Turiknox\RewardPoints\Model\ResourceModel\Transaction'
        );
    }
}
