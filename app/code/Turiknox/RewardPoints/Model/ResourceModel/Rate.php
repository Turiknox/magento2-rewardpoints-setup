<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Rate extends AbstractDb
{
    /**
     * Data constructor.
     *
     * @param Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Resource initialisation
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('turiknox_rewardpoints_rate', 'entity_id');
    }
}
