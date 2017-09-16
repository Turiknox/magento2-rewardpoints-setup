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

interface RateInterface
{
    const ENTITY_ID          = 'entity_id';
    const NAME               = 'name';
    const WEBSITE_IDS        = 'website_ids';
    const CUSTOMER_GROUP_IDS = 'customer_group_ids';
    const DIRECTION          = 'direction';
    const POINTS             = 'points';
    const MONEY              = 'money';
    const SORT_ORDER         = 'sort_order';

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
     * Get Name
     *
     * @return string
     */
    public function getName();

    /**
     * Set Name
     *
     * @param $name
     * @return RateInterface
     */
    public function setName($name);

    /**
     * Get Website IDs
     *
     * @return string
     */
    public function getWebsiteIds();

    /**
     * Set Website IDs
     *
     * @param $websiteIds
     * @return RateInterface
     */
    public function setWebsiteIds($websiteIds);

    /**
     * Get Customer Group IDs
     *
     * @return string
     */
    public function getCustomerGroupIds();

    /**
     * Set Customer Group IDs
     *
     * @param $customerGroupIds
     * @return RateInterface
     */
    public function setCustomerGroupIds($customerGroupIds);

    /**
     * Get Direction
     *
     * @return int
     */
    public function getDirection();

    /**
     * Set Direction
     *
     * @param $direction
     * @return RateInterface
     */
    public function setDirection($direction);

    /**
     * Get Points
     *
     * @return int
     */
    public function getPoints();

    /**
     * Set Points
     *
     * @param $points
     * @return RateInterface
     */
    public function setPoints($points);

    /**
     * Get Money
     *
     * @return float
     */
    public function getMoney();

    /**
     * Set Money
     *
     * @param $money
     * @return RateInterface
     */
    public function setMoney($money);

    /**
     * Get Sort Order
     *
     * @return int
     */
    public function getSortOrder();

    /**
     * Set Sort Order
     *
     * @param $sortOrder
     * @return RateInterface
     */
    public function setSortOrder($sortOrder);
}
