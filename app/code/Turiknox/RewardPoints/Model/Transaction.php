<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Model;

use Magento\Framework\Model\AbstractModel;
use Turiknox\RewardPoints\Api\Data\TransactionInterface;

class Transaction extends AbstractModel implements TransactionInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'turiknox_rewardpoints_transaction';

    /**
     * Initialise resource model
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('Turiknox\RewardPoints\Model\ResourceModel\Transaction');
    }

    /**
     * Get cache identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get Entity ID
     *
     * @return int
     */
    public function getEntityId()
    {
        return $this->getData(TransactionInterface::ENTITY_ID);
    }

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $entityId);
    }

    /**
     * Get Store ID
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(TransactionInterface::STORE_ID);
    }

    /**
     * Set Store ID
     *
     * @param $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $storeId);
    }

    /**
     * Get Order ID
     *
     * @return int
     */
    public function getOrderId()
    {
        return $this->getData(TransactionInterface::ORDER_ID);
    }

    /**
     * Set Order ID
     *
     * @param $orderId
     * @return $this
     */
    public function setOrderId($orderId)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $orderId);
    }

    /**
     * Get Customer Name
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->getData(TransactionInterface::CUSTOMER_NAME);
    }

    /**
     * Set Customer Name
     *
     * @param $customerName
     * @return $this
     */
    public function setCustomerName($customerName)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $customerName);
    }

    /**
     * Get Customer Email
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->getData(TransactionInterface::CUSTOMER_EMAIL);
    }

    /**
     * Set Customer Email
     *
     * @param $customerEmail
     * @return $this
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $customerEmail);
    }

    /**
     * Get Balance Change
     *
     * @return int
     */
    public function getBalanceChange()
    {
        return $this->getData(TransactionInterface::BALANCE_CHANGE);
    }

    /**
     * Set Balance Change
     *
     * @param $balanceChange
     * @return $this
     */
    public function setBalanceChange($balanceChange)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $balanceChange);
    }

    /**
     * Get Balance Remaining
     *
     * @return int
     */
    public function getBalanceRemaining()
    {
        return $this->getData(TransactionInterface::BALANCE_REMAINING);
    }

    /**
     * Set Balance Remaining
     *
     * @param $balanceRemaining
     * @return $this
     */
    public function setBalanceRemaining($balanceRemaining)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $balanceRemaining);
    }

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(TransactionInterface::CREATED_AT);
    }

    /**
     * Set Created At
     *
     * @param $createdAt
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(TransactionInterface::ENTITY_ID, $createdAt);
    }
}
