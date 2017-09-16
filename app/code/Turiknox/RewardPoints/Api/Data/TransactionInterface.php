<?php
/*
 * Turiknox_RewardPoints

 * @category   Turiknox
 * @package    Turiknox_RewardPoints
 * @copyright  Copyright (c) 2017 Turiknox
 * @license    https://github.com/Turiknox/magento2-rewardpoints-setup/blob/master/LICENSE.md
 * @version    1.0.0
 */
namespace Turiknox\RewardPoints\Api\Data;

interface TransactionInterface
{
    const ENTITY_ID         = 'entity_id';
    const STORE_ID          = 'store_id';
    const ORDER_ID          = 'order_id';
    const CUSTOMER_NAME     = 'customer_name';
    const CUSTOMER_EMAIL    = 'customer_email';
    const BALANCE_CHANGE    = 'balance_change';
    const BALANCE_REMAINING = 'balance_remaining';
    const CREATED_AT        = 'created_at';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set ID
     *
     * @param $id
     * @return RateInterface
     */
    public function setEntityId($id);

    /**
     * Get Store ID
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set Store ID
     *
     * @param $storeId
     * @return RateInterface
     */
    public function setStoreId($storeId);

    /**
     * Get Order ID
     *
     * @return int
     */
    public function getOrderId();

    /**
     * Set Order ID
     *
     * @param $orderId
     * @return RateInterface
     */
    public function setOrderId($orderId);

    /**
     * Get Customer Name
     *
     * @return string
     */
    public function getCustomerName();

    /**
     * Set Customer Name
     *
     * @param $customerName
     * @return RateInterface
     */
    public function setCustomerName($customerName);

    /**
     * Get Customer Email
     *
     * @return string
     */
    public function getCustomerEmail();

    /**
     * Set Customer Email
     *
     * @param $customerEmail
     * @return RateInterface
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Get Balance Change
     *
     * @return int
     */
    public function getBalanceChange();

    /**
     * Set Balance Change
     *
     * @param $balanceChange
     * @return RateInterface
     */
    public function setBalanceChange($balanceChange);

    /**
     * Get Balance Remaining
     *
     * @return int
     */
    public function getBalanceRemaining();

    /**
     * Set Balance Remaining
     *
     * @param $balanceRemaining
     * @return RateInterface
     */
    public function setBalanceRemaining($balanceRemaining);

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Set Created At
     *
     * @param $createdAt
     * @return RateInterface
     */
    public function setCreatedAt($createdAt);
}
