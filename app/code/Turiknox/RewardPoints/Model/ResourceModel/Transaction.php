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
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Transaction extends AbstractDb
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param DateTime $date
     */
    public function __construct(
        Context $context,
        DateTime $date
    ) {
        parent::__construct($context);
        $this->date = $date;
    }

    /**
     * Resource initialisation
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('turiknox_rewardpoints_transaction', 'entity_id');
    }

    /**
     * Before save callback
     *
     * @param AbstractModel|\Turiknox\RewardPoints\Model\Transaction $transaction
     * @return \Magento\Framework\Model\ResourceModel\Db\AbstractDb
     */
    protected function _beforeSave(AbstractModel $transaction) // @codingStandardsIgnoreLine
    {
        if ($transaction->isObjectNew()) {
            $transaction->setCreatedAt($this->date->gmtDate());
        }
        return parent::_beforeSave($transaction);
    }
}
