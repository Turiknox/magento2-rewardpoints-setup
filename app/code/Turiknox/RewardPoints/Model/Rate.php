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
use Turiknox\RewardPoints\Api\Data\RateInterface;

class Earningrate extends AbstractModel implements RateInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'turiknox_rewardpoints_rate';

    /**
     * Initialise resource model
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        $this->_init('Turiknox\RewardPoints\Model\ResourceModel\Earningrate');
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
        return $this->getData(RateInterface::ENTITY_ID);
    }

    /**
     * Set Entity ID
     *
     * @param int $entityId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(RateInterface::ENTITY_ID, $entityId);
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(RateInterface::NAME);
    }

    /**
     * Set Name
     *
     * @param $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(RateInterface::NAME, $name);
    }

    /**
     * Get Website IDs
     *
     * @return string
     */
    public function getWebsiteIds()
    {
        return $this->getData(RateInterface::WEBSITE_IDS);
    }

    /**
     * Set Website IDs
     *
     * @param $websiteIds
     * @return $this
     */
    public function setWebsiteIds($websiteIds)
    {
        return $this->setData(RateInterface::WEBSITE_IDS, $websiteIds);
    }

    /**
     * Get Customer Group IDs
     *
     * @return string
     */
    public function getCustomerGroupIds()
    {
        return $this->getData(RateInterface::CUSTOMER_GROUP_IDS);
    }

    /**
     * Set Customer Group IDs
     *
     * @param $customerGroupIds
     * @return $this
     */
    public function setCustomerGroupIds($customerGroupIds)
    {
        return $this->setData(RateInterface::CUSTOMER_GROUP_IDS, $customerGroupIds);
    }

    /**
     * Get Direction
     *
     * @return int
     */
    public function getDirection()
    {
        return $this->getData(RateInterface::DIRECTION);
    }

    /**
     * Set Direction
     *
     * @param $direction
     * @return $this
     */
    public function setDirection($direction)
    {
        return $this->setData(RateInterface::DIRECTION, $direction);
    }

    /**
     * Get Points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->getData(RateInterface::POINTS);
    }

    /**
     * Set Points
     *
     * @param $points
     * @return $this
     */
    public function setPoints($points)
    {
        return $this->setData(RateInterface::DIRECTION, $points);
    }

    /**
     * Get Money
     *
     * @return float
     */
    public function getMoney()
    {
        return $this->getData(RateInterface::MONEY);
    }

    /**
     * Set Money
     *
     * @param $money
     * @return $this
     */
    public function setMoney($money)
    {
        return $this->setData(RateInterface::MONEY, $money);
    }

    /**
     * Get Sort Order
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->getData(RateInterface::SORT_ORDER);
    }

    /**
     * Set Sort Order
     *
     * @param $sortOrder
     * @return $this
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(RateInterface::SORT_ORDER, $sortOrder);
    }
}
